<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Laravel',
            'workload' => '20'
        ]);

        Course::create([
            'name' => 'PHP',
            'workload' => '40'
        ]);

        Course::create([
            'name' => 'Javascript',
            'workload' => '35'
        ]);

        Course::create([
            'name' => 'MongoDB',
            'workload' => '25'
        ]);

        Course::create([
            'name' => 'ReactJS',
            'workload' => '50'
        ]);

        Course::create([
            'name' => 'MySQL',
            'workload' => '5'
        ]);

        Student::create([
            'name' => 'Lucas Assis',
            'image' => 'wbwAdJWTXI_1600994025.png',
        ])->courses()->sync([1, 2, 3, 4, 5, 6]);
    }
}
