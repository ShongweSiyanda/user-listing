<?php

namespace App\Http\Controllers;

use App\Models\UserListing;
use App\Repositories\Interfaces\UserListingRepositoryInterface;
use Illuminate\Http\Request;

class UserListingController extends Controller
{
    private $userListingRepository;

    public function __construct(UserListingRepositoryInterface $userListingRepository)
    {
        $this->userListingRepository = $userListingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $allUsers = $this->userListingRepository->allUserListing();
            if ($allUsers) {
                return view('index', ['allUsers' => $allUsers]);
            }
        } catch (\Exception $PDOException) {
            return view('index', ['errors' => $PDOException]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserListing  $userListing
     * @return \Illuminate\Http\Response
     */
    public function show(UserListing $userListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserListing  $userListing
     * @return \Illuminate\Http\Response
     */
    public function edit(UserListing $userListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserListing  $userListing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserListing $userListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserListing  $userListing
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserListing $userListing)
    {
        //
    }
}
