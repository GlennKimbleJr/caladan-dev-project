<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Teacher;
use App\Http\Requests\CreateTeacherRequest;

class MainController extends Controller
{
    public function index()
    {
        $teachers = Teacher::get();
        // There are a better ways to do this... :)
        foreach ($teachers as $teacher) {
            $teacher->full_name = $teacher->first_name . ' ' . $teacher->last_name;
            $teacher->grades = json_decode($teacher->grades, true);
        }

        return Inertia::render('index', [
            'teachers' => $teachers,
            'create_teacher_url' => route('teachers.create'),
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
        ]);

        $request->session()->flash('message', 'The teacher was succesfully added.');

        return redirect()->to(route('main.index'));
    }
}
