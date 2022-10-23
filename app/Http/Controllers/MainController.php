<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Teacher;
use Illuminate\Http\Request;

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
            'teachers' => $teachers
        ]);
    }

    public function create()
    {

    }

    public function store(CreateTeacherRequest $request)
    {
        Teacher::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'school' => $request->get('school'),
            'grades' => json_encode($request->get('grades')),
        ]);

        return redirect()->to(route('main.index'));
    }
}
