<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'grades' => json_encode($this->faker->randomElements(['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th'], 2)),
            'subjects' => json_encode($this->faker->randomElements(['English', 'Math', 'Science', 'History'], 2)),
        ];
    }
}
