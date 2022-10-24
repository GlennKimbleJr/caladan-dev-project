<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Teacher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTeacherTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_page_loads()
    {
        $this->get(route('teachers.create'))
            ->assertStatus(200)
            ->assertInertia(function ($page) {
                $page
                    ->component('teachers/create')
                    ->has('teacher_index_url')
                    ->has('save_teacher_url');
            });
    }

    /**
     * Return an array of the necessary defaults to create a teacher.
     *
     * @param  array  $override
     * @return array
     */
    private function validParameters(array $override): array
    {
        return array_merge([
            'first_name' => 'Joe',
            'last_name' => 'Bob',
            'school' => 'Main High School',
            'grades' => Teacher::getAvailableGrades(),
            'subjects' => Teacher::getAvailableSubjects(),
        ], $override);
    }

    /** @test */
    public function a_teacher_can_be_created()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'first_name' => 'Joe',
            'last_name' => 'Bob',
            'school' => 'Main High School',
            'grades' => Teacher::getAvailableGrades(),
            'subjects' => Teacher::getAvailableSubjects(),
        ]))
            ->assertRedirect(route('main.index'))
            ->assertSessionHas('message', 'The teacher was succesfully added.');

        $teacher = Teacher::first();
        $this->assertEquals('Joe', $teacher->first_name);
        $this->assertEquals('Bob', $teacher->last_name);
        $this->assertEquals('Main High School', $teacher->school);
        $this->assertEquals(Teacher::getAvailableGrades(), $teacher->grades);
        $this->assertEquals(Teacher::getAvailableSubjects(), $teacher->subjects);
    }

    /** @test */
    public function first_name_is_required()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'first_name' => null,
        ]))->assertInvalid(['first_name' => 'required']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function first_name_must_be_a_string()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'first_name' => 0,
        ]))->assertInvalid(['first_name' => 'string']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function last_name_is_required()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'last_name' => null,
        ]))->assertInvalid(['last_name' => 'required']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function last_name_must_be_a_string()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'last_name' => 0,
        ]))->assertInvalid(['last_name' => 'string']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function school_is_required()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'school' => null,
        ]))->assertInvalid(['school' => 'required']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function school_must_be_a_string()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'school' => 0,
        ]))->assertInvalid(['school' => 'string']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function grades_are_optional()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'grades' => null,
        ]));

        $this->assertEquals(1, Teacher::count());
    }

    /** @test */
    public function grades_must_be_an_array()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'grades' => 'not an array',
        ]))->assertInvalid(['grades' => 'array']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function grade_input_is_restricted_to_certain_grades()
    {
        $this->post(route('teachers.store'), $this->validParameters([
            'grades' => ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th'],
        ]))->assertSessionHas('message', 'The teacher was succesfully added.');

        $this->post(route('teachers.store'), $this->validParameters([
            'grades' => ['9th'],
        ]))->assertInvalid(['grades' => 'in']);
    }

    /** @test */
    public function subjects_are_optional()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'subjects' => null,
        ]));

        $this->assertEquals(1, Teacher::count());
    }

    /** @test */
    public function subjects_must_be_an_array()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'subjects' => 'not an array',
        ]))->assertInvalid(['subjects' => 'array']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function subject_input_is_restricted_to_certain_subjects()
    {
        $this->post(route('teachers.store'), $this->validParameters([
            'subjects' => ['English', 'Math', 'Science', 'History'],
        ]))->assertSessionHas('message', 'The teacher was succesfully added.');

        $this->post(route('teachers.store'), $this->validParameters([
            'subjects' => ['Economics'],
        ]))->assertInvalid(['subjects' => 'in']);
    }

    /** @test */
    public function a_profile_photo_is_not_required()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'profile_photo' => null
        ]))
            ->assertRedirect(route('main.index'))
            ->assertSessionHas('message', 'The teacher was succesfully added.');

        $this->assertEquals('default.png', Teacher::first()->profile_photo_path);
    }

    /** @test */
    public function a_profile_photo_can_be_uploaded()
    {
        Storage::fake();

        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'profile_photo' => UploadedFile::fake()->image('photo1.jpg'),
        ]))
            ->assertRedirect(route('main.index'))
            ->assertSessionHas('message', 'The teacher was succesfully added.');

        Storage::disk('public')->assertExists(Teacher::first()->profile_photo_path);
    }

    /** @test */
    public function a_profile_photo_must_be_an_uploaded_file()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'profile_photo' => 'not a photo',
        ]))->assertInvalid(['profile_photo' => 'file']);

        $this->assertEquals(0, Teacher::count());
    }

    /** @test */
    public function a_profile_photo_must_be_an_image()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'profile_photo' => UploadedFile::fake()->image('document.pdf'),
        ]))->assertInvalid(['profile_photo' => 'image']);

        $this->assertEquals(0, Teacher::count());
    }
}
