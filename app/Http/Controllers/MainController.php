<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTeacherRequest;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::get();
        // There are a better ways to do this... :)
        foreach ($teachers as $teacher) {
            $teacher->full_name = $teacher->first_name . ' ' . $teacher->last_name;
            $teacher->grades = json_decode($teacher->grades, true);
            $teacher->subjects = json_decode($teacher->subjects, true);
        }

        return Inertia::render('index', [
            'teachers' => $teachers,
            'create_teacher_url' => route('teachers.create'),
            'flash_message' => $request->session()->get('message'),
        ]);
    }

    public function create()
    {
        return Inertia::render('teachers/create', [
            'teacher_index_url' => route('main.index'),
            'save_teacher_url' => route('teachers.store'),
        ]);
    }

    public function store(CreateTeacherRequest $request)
    {
        Teacher::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'school' => $request->get('school'),
            'grades' => json_encode($request->get('grades')),
            'subjects' => json_encode($request->get('subjects')),
            'profile_photo_path' => $request->hasFile('profile_photo')
                ? $request->file('profile_photo')->store('users', 'public')
                : 'default.png',
        ]);

        $request->session()->flash('message', 'The teacher was succesfully added.');

        return redirect()->to(route('main.index'));
    }
}
