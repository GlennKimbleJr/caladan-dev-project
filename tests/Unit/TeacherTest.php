<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_full_name_attribute_is_the_teachers_first_and_last_name()
    {
        $teacher = Teacher::factory()->create([
            'first_name' => 'Joe',
            'last_name' => 'Bob',
        ]);

        $this->assertEquals('Joe Bob', $teacher->full_name);
    }

    /** @test */
    public function the_grades_attribute_is_an_array()
    {
        $teacher = Teacher::factory()->create([
            'grades' => ['1st', '2nd'],
        ]);

        $this->assertEquals(['1st', '2nd'], $teacher->grades);
    }

    /** @test */
    public function the_subjects_attribute_is_an_array()
    {
        $teacher = Teacher::factory()->create([
            'subjects' => ['English', 'Math'],
        ]);

        $this->assertEquals(['English', 'Math'], $teacher->subjects);
    }
}
