<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Course;
use App\Services\ImageService;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\DB;
use Excepetion;

class StudentRepository
{
    protected $model;
    protected $courseRepo;
    protected $imageService;

    public function __construct(Student $model, ImageService $imageService, CourseRepository $courseRepo)
    {
        $this->model = $model;
        $this->courseRepo = $courseRepo;
        $this->imageService = $imageService;
    }

    public function getAll($paginate = false)
    {
        if ($paginate) {
            $data = $this->model->paginate($paginate);
        } else {
            $data = $this->model->all();
        }

        return $data;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $student = $this->model->create([
                'name' => $request->name,
                'image' => $request->file('image') ? $this->imageService->saveImage($request->file('image'), config('media.image')) : null,
            ]);

            if ($request->courses) {
                $student->courses()->sync($this->courseRepo->createCourseList($request->courses));
            }

            DB::commit();

            return $student;
        } catch (Excepetion $e) {
            \Log::info($e);
            DB::rollback();
            return false;
        }
    }

    public function destroy($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $student = $this->model->findOrFail($id);

            $student->name = $request->name;

            if ($request->file('image')) {
                $student->image = $student->image ? $this->imageService->updateImage($request->file('image'), $student->image, config('media.image')) : $this->imageService->saveImage($request->file('image'), config('media.image'));
            }

            if ($request->courses) {
                $student->courses()->sync($this->courseRepo->createCourseList($request->courses));
            }

            $student->save();

            DB::commit();

            return $student;
        } catch (Excepetion $e) {
            \Log::info($e);
            DB::rollback();
            return false;
        }
    }

}
