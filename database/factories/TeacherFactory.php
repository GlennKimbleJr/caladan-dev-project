<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'school' => $this->faker->company,
            'grades' => $this->faker->randomElements(Teacher::getAvailableGrades(), 2),
            'subjects' => $this->faker->randomElements(Teacher::getAvailableSubjects(), 2),
            'profile_photo_path' => 'default.png',
        ];
    }
}
