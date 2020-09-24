<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Course;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Excepetion;

class StudentRepository
{
    protected $model;
    protected $imageService;

    public function __construct(Student $model, ImageService $imageService)
    {
        $this->model = $model;
        $this->imageService = $imageService;
    }

    public function getAll($paginate = 10)
    {
        return $this->model->paginate($paginate);
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
                $student->courses()->sync($this->createCourseList($request->courses));
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
                $student->courses()->sync($this->createCourseList($request->courses));
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

    public function createCourseList(array $input)
    {
        $list = [];

        foreach ($input as $course) {
            if (Course::whereName($course)->count() > 0) {
                $list[] = Course::whereName($course)->first()->id;
            }
        }

        return $list;
    }
}
