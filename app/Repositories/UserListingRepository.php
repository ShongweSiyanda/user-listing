<?php

namespace App\Repositories;

use App\Models\UserListing;
use App\Repositories\Interfaces\UserListingRepositoryInterface;

class UserListingRepository implements UserListingRepositoryInterface
{
    public function listAllUsers()
    {
        return UserListing::orderBy('created_at', 'desc')->paginate(10);
    }
    public function destroyUser($id)
    {
        $user = UserListing::where('user_id',$id);
        $user->delete();
    }
    public function storeUser($data)
    {
        return UserListing::create($data);
    }
}
