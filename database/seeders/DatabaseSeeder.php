<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\StudentInSection;
use App\Models\Material;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        // Create 1 super admin
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'password' => $password,
            'is_super_admin' => true,
            'role' => null,
            'category' => null,
        ]);

        // Create 3 admins (tutors with categories)
        User::create([
            'name' => 'Primary Admin',
            'username' => 'primaryadmin',
            'email' => 'primaryadmin@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'primary',
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Lower Secondary Admin',
            'username' => 'lowersecondaryadmin',
            'email' => 'lowersecondaryadmin@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'lower_secondary',
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Upper Secondary Admin',
            'username' => 'uppersecondaryadmin',
            'email' => 'uppersecondaryadmin@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'upper_secondary',
            'is_admin' => true,
        ]);

        // Create 6 tutors (2 for each category)
        $tutor1 = User::create([
            'name' => 'Tutor One',
            'username' => 'tutor1',
            'email' => 'tutor1@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'primary',
            'is_admin' => false,
        ]);

        $tutor2 = User::create([
            'name' => 'Tutor Two',
            'username' => 'tutor2',
            'email' => 'tutor2@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'primary',
            'is_admin' => false,
        ]);

        $tutor3 = User::create([
            'name' => 'Tutor Three',
            'username' => 'tutor3',
            'email' => 'tutor3@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'lower_secondary',
            'is_admin' => false,
        ]);

        $tutor4 = User::create([
            'name' => 'Tutor Four',
            'username' => 'tutor4',
            'email' => 'tutor4@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'lower_secondary',
            'is_admin' => false,
        ]);

        $tutor5 = User::create([
            'name' => 'Tutor Five',
            'username' => 'tutor5',
            'email' => 'tutor5@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'upper_secondary',
            'is_admin' => false,
        ]);

        $tutor6 = User::create([
            'name' => 'Tutor Six',
            'username' => 'tutor6',
            'email' => 'tutor6@example.com',
            'password' => $password,
            'role' => 'tutor',
            'category' => 'upper_secondary',
            'is_admin' => false,
        ]);

        // Create 24 students (8 for each category)
        for ($i = 1; $i <= 24; $i++) {
            User::create([
            'name' => "Student $i",
            'username' => "student$i",
            'email' => "student$i@example.com",
            'password' => $password,
            'role' => 'student',
            'category' => $i <= 8 ? 'primary' : ($i <= 16 ? 'lower_secondary' : 'upper_secondary'),
            'is_admin' => false,
            ]);
        }

        // Create 2 courses for each category
        $course1 = Course::create([
            'course_name' => 'Primary Course One',
            'category' => 'primary',
        ]);

        $course2 = Course::create([
            'course_name' => 'Primary Course Two',
            'category' => 'primary',
        ]);

        $course3 = Course::create([
            'course_name' => 'Lower Secondary Course One',
            'category' => 'lower_secondary',
        ]);

        $course4 = Course::create([
            'course_name' => 'Lower Secondary Course Two',
            'category' => 'lower_secondary',
        ]);

        $course5 = Course::create([
            'course_name' => 'Upper Secondary Course One',
            'category' => 'upper_secondary',
        ]);

        $course6 = Course::create([
            'course_name' => 'Upper Secondary Course Two',
            'category' => 'upper_secondary',
        ]);

        // Create 2 sections for each course
        $section1 = Section::create([
            'section_number' => 1,
            'course_id' => $course1->id,
            'tutor_id' => $tutor1->id,
        ]);

        $section2 = Section::create([
            'section_number' => 2,
            'course_id' => $course1->id,
            'tutor_id' => $tutor1->id,
        ]);

        $section3 = Section::create([
            'section_number' => 1,
            'course_id' => $course2->id,
            'tutor_id' => $tutor2->id,
        ]);

        $section4 = Section::create([
            'section_number' => 2,
            'course_id' => $course2->id,
            'tutor_id' => $tutor2->id,
        ]);

        $section5 = Section::create([
            'section_number' => 1,
            'course_id' => $course3->id,
            'tutor_id' => $tutor3->id,
        ]);

        $section6 = Section::create([
            'section_number' => 2,
            'course_id' => $course3->id,
            'tutor_id' => $tutor3->id,
        ]);

        $section7 = Section::create([
            'section_number' => 1,
            'course_id' => $course4->id,
            'tutor_id' => $tutor4->id,
        ]);

        $section8 = Section::create([
            'section_number' => 2,
            'course_id' => $course4->id,
            'tutor_id' => $tutor4->id,
        ]);

        $section9 = Section::create([
            'section_number' => 1,
            'course_id' => $course5->id,
            'tutor_id' => $tutor5->id,
        ]);

        $section10 = Section::create([
            'section_number' => 2,
            'course_id' => $course5->id,
            'tutor_id' => $tutor5->id,
        ]);

        $section11 = Section::create([
            'section_number' => 1,
            'course_id' => $course6->id,
            'tutor_id' => $tutor6->id,
        ]);

        $section12 = Section::create([
            'section_number' => 2,
            'course_id' => $course6->id,
            'tutor_id' => $tutor6->id,
        ]);

        // Assign students to sections
        $sections = [
            $section1, $section2, $section3, $section4, $section5, $section6,
            $section7, $section8, $section9, $section10, $section11, $section12
        ];

        for ($i = 0; $i < 24; $i++) {
            StudentInSection::create([
            'section_id' => $sections[intval($i / 2)]->id,
            'student_id' => $i + 11,
            ]);
        }

        // Create materials
        $superAdmin = User::where('username', 'superadmin')->first();

        Material::create([
            'visible_to_all' => true,
            'section_id' => null,
            'user_id' => $superAdmin->id,
            'message' => 'Super Admin Announcement for All!',
            'image' => null,
            'video' => null,
            'file_path' => null,
            'tag' => 'announcement',
        ]);

        $users = User::whereIn('role', ['tutor', 'admin'])->get();
        $sections = Section::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $section = $sections->where('tutor_id', $user->id)->random();
                Material::create([
                    'visible_to_all' => (bool)random_int(0, 1),
                    'section_id' => $section->id,
                    'user_id' => $user->id,
                    'message' => "Material $i by {$user->name} for Section {$section->section_number}",
                    'image' => null,
                    'video' => null,
                    'file_path' => null,
                    'tag' => 'notes',
                ]);
            }
        }

        // Call MaterialSeeder
        $this->call(MaterialSeeder::class);
    }
}
