<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentConcern;


class StudentConcernSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed example student concerns
        StudentConcern::create([
            'student_id' => 1, // Example student
            'concern' => 'I need help with my enrollment.',
        ]);

        StudentConcern::create([
            'student_id' => 2,
            'concern' => 'Can I change my section?',
        ]);

        // Call the concern seeder
        $this->call(StudentConcernSeeder::class);
    }


}
