<?php

namespace Database\Factories;


use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use phpseclib3\Crypt\RSA;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Companies>
 */
class CompaniesFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Companies::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$name = $this->faker->name();
        return [
            'name' => $name,
	        'slug' => Str::slug($name, '-'),
			'rsa_key' => RSA::createKey(2048)->withHash('sha256')->getPublicKey()->toString('PKCS8')
        ];
    }
}
