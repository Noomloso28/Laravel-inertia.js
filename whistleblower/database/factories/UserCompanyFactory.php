<?php

namespace Database\Factories;

use App\Models\UserCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCompany>
 */
class UserCompanyFactory extends Factory
{
    protected $model = UserCompany::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'company_id' => 1
        ];
    }
}
