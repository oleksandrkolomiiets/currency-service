<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CurrencyApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testApiAuth()
    {
        $response = $this->get('/api/currencies');

        $response->assertStatus(302);
    }

    public function testSuccessResponse()
    {
        $users = User::factory(1)->create();

        $this->actingAs($users->first(), 'sanctum');

        $response = $this->get('api/currencies');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'links',
            'meta' => [
                'current_page',
                'last_page',
                'links',
                'from',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }
}
