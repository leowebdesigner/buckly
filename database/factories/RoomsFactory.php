<?php

namespace Database\Factories;

use App\Models\Rooms;
use App\Models\Hotels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotels>
 */
class RoomsFactory extends Factory
{

    protected $model = Rooms::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->unique()->sentence(15),
            'hotel_id' => Hotels::factory(),
        ];
    }
}
