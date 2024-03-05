<?php

namespace Database\Factories;

use App\Models\Occurrences;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Occurrences>
 */
class OccurrencesFactory extends Factory
{
    protected $model = Occurrences::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_id' => 1,
            'category_id' => 1,
            'severity' => 1,
            'status' => true,
            'department_id' => 1,
            'topic' => $this->faker->title,
            'description' => $this->faker->text,
            'classification' => 'test',
            'email' => $this->faker->email
        ];
    }
}
