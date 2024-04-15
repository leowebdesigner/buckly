<?php

namespace Database\Factories;

use App\Models\Hotels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotels>
 */
class HotelsFactory extends Factory
{

    protected $model = Hotels::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->unique()->sentence(15),
            'city' => $this->faker->name(),
            'state' => $this->faker->name(),
            'zip_code' => $this->faker->randomNumber(9, true),
            'website' => $this->faker->url(),
        ];
    }
}
