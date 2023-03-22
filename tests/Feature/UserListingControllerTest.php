<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserListingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_listing()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_create_new_user()
    {

        $data = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test.test@testmail.com',
            'position' => 'Tester',
        ];

        $this->post('/', $data);
        $this->assertDatabaseHas('user_listings', $data);
    }
}
