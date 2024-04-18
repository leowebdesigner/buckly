<?php

namespace Tests\Feature\Api;

use App\Models\User;

trait TestsTrait
{
      public function createTokenUser()
      {
        $user = User::factory()->create();
        $token = $user->createToken('teste')->plainTextToken;

        return $token;
      }

      public function defaultHeaders()
      {

        $token = $this->createTokenUser();

        return [
            'Authorization' => "Bearer {$token}",
        ];
      }
}
