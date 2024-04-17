<?php

namespace Database\Factories;

use App\Models\Hotels;
use App\Services\ViaCepService;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotels::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $viaCepService = app(ViaCepService::class);
        $ceps = ['05407002', '01153000', '13484015'];
        $cep = $this->faker->randomElement($ceps);
        $addressData = $viaCepService->getAddressDetails($cep);

        return [
            'name' => $this->faker->company(),
            'address' => $addressData['address'] ?? $this->faker->streetAddress(),
            'city' => $addressData['city'] ?? $this->faker->city(),
            'state' => $addressData['state'] ?? $this->faker->state(),
            'zip_code' => $addressData['zip_code'] ?? $cep,
            'website' => $this->faker->url(),
        ];
    }
}
