<?php

namespace Database\Factories;

use App\Models\Departments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departments>
 */
class DepartmentsFactory extends Factory
{
	protected $model = Departments::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
	        'name' => $this->faker->name(),
	        'default' => true
        ];
    }
}
