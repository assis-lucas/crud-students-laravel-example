<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Excepetion;

class CourseRepository
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
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

            $course = $this->model->create([
                'name' => $request->name,
                'workload' => $request->workload,
            ]);

            DB::commit();

            return $course;
        } catch (Excepetion $e) {
            \Log::info($e);
            DB::rollback();
            return false;
        }
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $course = $this->model->findOrFail($id);

            $course->update($request->all());

            DB::commit();

            return $course;
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
