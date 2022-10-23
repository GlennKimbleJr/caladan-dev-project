<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Teacher;
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
            'grades' => [9,10,11,12],
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
            'grades' => [9,10,11,12],
        ]))
            ->assertRedirect(route('main.index'))
            ->assertSessionHas('message', 'The teacher was succesfully added.');

        $teacher = Teacher::first();
        $this->assertEquals('Joe', $teacher->first_name);
        $this->assertEquals('Bob', $teacher->last_name);
        $this->assertEquals('Main High School', $teacher->school);
        $this->assertEquals('[9,10,11,12]', $teacher->grades);
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
    public function grades_is_required()
    {
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'grades' => null,
        ]))->assertInvalid(['grades' => 'required']);

        $this->assertEquals(0, Teacher::count());
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
}
