<?php

namespace Tests\Feature;

use App\Repositories\UserListingRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserListingRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_all_users()
    {
        $record = [
            'first_name' => 'Test',
            'last_name' => 'Repo',
            'email' => 'test.repo@testmail.com',
            'position' => 'Tester',
        ];

        $userListingRepository = new UserListingRepository();

        $userListingRepository->storeUser($record);

        $result = $userListingRepository->listAllUsers();
        $this->assertCount(1,$result);
        $this->assertEquals('Repo', $result[0]->last_name);
    }
}
