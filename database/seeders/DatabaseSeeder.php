<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentQualification;
use App\Models\Course;
use App\Models\StudentCourse;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $student = Student::factory()->create();
        $course = Course::factory()->create();
        

        StudentQualification::factory()->create([
            'student_id' => $student->id,
        ]);

        StudentCourse::factory()->create([
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);
        
    }
}
