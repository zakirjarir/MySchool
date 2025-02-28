<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Disable Foreign Key Checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all tables
        DB::table('exam_results')->truncate();
        DB::table('exams')->truncate();
        DB::table('assignments')->truncate();
        DB::table('questions')->truncate();
        DB::table('subjects')->truncate();
        DB::table('sections')->truncate();
        DB::table('classes')->truncate();

        // Enable Foreign Key Checks Again
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Classes Table Data
        DB::table('classes')->insert([
            ['name' => 'Class 6', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Class 7', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Class 8', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sections Table Data
        DB::table('sections')->insert([
            ['class_id' => 1, 'name' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 1, 'name' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 2, 'name' => 'A', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Subjects Table Data
        DB::table('subjects')->insert([
            ['class_id' => 1, 'name' => 'Mathematics', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 1, 'name' => 'Science', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 2, 'name' => 'English', 'created_at' => now(), 'updated_at' => now()],
        ]);


        // Assignments Table Data
        DB::table('assignments')->insert([
            ['class_id' => 1, 'section_id' => 1, 'subject_id' => 1, 'teacher_id' => 1, 'title' => 'Algebra Homework', 'description' => 'Complete exercise 5', 'due_date' => '2025-02-15', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Exams Table Data
        DB::table('exams')->insert([
            ['name' => 'Midterm', 'class_id' => 1, 'subject_id' => 1, 'exam_date' => '2025-03-10', 'total_marks' => 100, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Exam Results Table Data
        DB::table('exam_results')->insert([
            ['exam_id' => 1, 'student_id' => 1, 'obtained_marks' => 80, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Questions Table Data
        DB::table('questions')->insert([
            ['subject_id' => 1, 'question_text' => 'What is 2 + 2?', 'options' => json_encode(['2', '3', '4', '5']), 'correct_answer' => '4', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
