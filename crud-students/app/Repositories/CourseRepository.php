<?php

namespace App\Repositories;

class CourseRepository{

    protected $courseModel;

    public function __construct(Course $courseModel)
    {
        $this->courseModel = $courseModel;
    }


}
