<?php

namespace Tests\Feature\Api;

use App\Models\Hotels;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelsTest extends TestCase
{
    use TestsTrait;

    public function test_unauthenticated_hotels(): void
    {
        $response = $this->getJson('/hotels');

        $response->assertStatus(401);
    }

    public function test_get_hotels(): void
    {
        $response = $this->getJson('/hotels',$this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_hotels_total(): void
    {
        $hotels = Hotels::factory()->count(10)->create();

        $response = $this->getJson('/hotels',$this->defaultHeaders());

        $response->assertStatus(200)
                 ->assertJsonCount(count($hotels), 'data');
    }

    public function test_get_single_hotels_unauthenticated(): void
    {
        $response = $this->getJson('/hotels/auhidshai');

        $response->assertStatus(401);
    }

    public function test_get_single_hotels_not_found(): void
    {
        $response = $this->getJson('/hotels/asuihdi', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function test_get_single_hotels(): void
    {
        $hotels = Hotels::factory()->create();

        $response = $this->getJson("/hotels/{$hotels->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_create_hotels_error_validations(): void
    {
        $response = $this->postJson("/hotels",[], $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function test_create_hotels(): void
    {
        $payload = [
            'name' => 'teste do php',
            'zip_code' => '01153000',
            'website' => 'www.testedophp.com.br'
        ];

        $response = $this->postJson("/hotels", $payload , $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
