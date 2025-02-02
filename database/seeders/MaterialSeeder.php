<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Section;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Seed the application's materials.
     */
    public function run(): void
    {
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
    }
}
