<?php
namespace App\Repositories\Interfaces;

Interface UserListingRepositoryInterface{

    public function allUserListing();
    /*public function storeUser($data);*/
    public function destroyUser($id);
}
