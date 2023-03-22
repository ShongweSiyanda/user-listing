<?php
namespace App\Repositories\Interfaces;

Interface UserListingRepositoryInterface{

    public function listAllUsers();
    public function storeUser($data);
    public function destroyUser($id);
}
