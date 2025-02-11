<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use App\Models\StudentInSection;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * List all users, courses, and sections.
     */
    public function index()
    {
        $users = User::all();
        $courses = Course::all();
        $sections = Section::all();

        return view('admin.index', compact('users', 'courses', 'sections'));
    }

    public function showPrimaryAdminPage()
    {
        $courses = Course::where('category', 'primary')->get();
        $sections = Section::all();
        $users = User::all();

        return view('admin.primary', [
            'courses' => $courses,
            'sections' => $sections,
            'users' => $users,
        ]);
    }

    public function showLowerSecondaryAdminPage()
    {
        $courses = Course::where('category', 'lower_secondary')->get();
        $sections = Section::all();
        $users = User::all();

        return view('admin.lower_secondary', [
            'courses' => $courses,
            'sections' => $sections,
            'users' => $users,
        ]);
    }

    public function showUpperSecondaryAdminPage()
    {
        $courses = Course::where('category', 'upper_secondary')->get();
        $sections = Section::all();
        $users = User::all();

        return view('admin.upper_secondary', [
            'courses' => $courses,
            'sections' => $sections,
            'users' => $users,
        ]);
    }

    /**
     * Create a new course.
     */
    public function createCourse(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'category' => 'required|in:primary,lower_secondary,upper_secondary',
        ]);

        $course = Course::create([
            'course_name' => $request->course_name,
            'category' => $request->category,
        ]);

        return redirect()->back()->with('success_course', 'Course created successfully!');
    }

    /**
     * Create a new section for a course.
     */
    public function createSection(Request $request)
    {
        $request->validate([
            'section_number' => 'required|integer',
            'course_id' => 'required|exists:courses,id',
            'tutor_id' => 'required|exists:users,id',
        ]);

        $tutor = User::where('id', $request->tutor_id)->where('role', 'tutor')->firstOrFail();

        $section = Section::create([
            'section_number' => $request->section_number,
            'course_id' => $request->course_id,
            'tutor_id' => $tutor->id,
        ]);

        return redirect()->back()->with('success_section', 'Section created successfully!');
    }

    /**
     * Assign students to a section.
     */
    public function assignStudentsToSection(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'student_id' => 'required|array',
            'student_id.*' => 'exists:users,id',
        ]);

        $section = Section::findOrFail($request->section_id);

        foreach ($request->student_id as $student_id) {
            $student = User::where('id', $student_id)->where('role', 'student')->firstOrFail();
            StudentInSection::create([
                'section_id' => $section->id,
                'student_id' => $student->id,
            ]);
        }

        return redirect()->back()->with('success_assign', 'Students assigned successfully!');
    }

    
}
