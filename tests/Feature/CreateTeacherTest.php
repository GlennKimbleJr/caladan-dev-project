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
        $this->get(route('teachers.create'))->assertStatus(200);
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
        $this->withoutExceptionHandling();
        $this->assertEquals(0, Teacher::count());

        $this->post(route('teachers.store'), $this->validParameters([
            'first_name' => 'Joe',
            'last_name' => 'Bob',
            'school' => 'Main High School',
            'grades' => [9,10,11,12],
        ]))->assertRedirect(route('main.index'));

        $teacher = Teacher::first();
        $this->assertEquals('Joe', $teacher->first_name);
        $this->assertEquals('Bob', $teacher->last_name);
        $this->assertEquals('Main High School', $teacher->school);
        $this->assertEquals('[9,10,11,12]', $teacher->grades);
    }
}
