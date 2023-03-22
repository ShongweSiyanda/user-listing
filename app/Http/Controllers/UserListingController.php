<?php

namespace App\Http\Controllers;

use App\Models\UserListing;
use App\Repositories\Interfaces\UserListingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserListingController extends Controller
{
    private UserListingRepositoryInterface $userListingRepository;

    public function __construct(UserListingRepositoryInterface $userListingRepository)
    {
        $this->userListingRepository = $userListingRepository;
    }


    public function index()
    {
        try {
            $allUsers = $this->userListingRepository->listAllUsers();
            if ($allUsers) {
                return view('index', ['allUsers' => $allUsers]);
            }
        } catch (\Exception $PDOException) {
            return view('index', ['errors' => $PDOException]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $data = [
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'position' => $request->position,
           ];

            $validator = Validator::make($data, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'position' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $this->userListingRepository->storeUser($data);
            $response = response()->json(['success' => 'New user successfully added.']);

        }
        catch (\Exception $exception){
            $response = response()->json(['error' => $exception]);
        }

        return $response;
    }


    /**
     * Deletes a selected user
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Status of the request - true when record is found and deleted
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->userListingRepository->destroyUser($id);
        return response()->json(['success' => 'User Deleted Successfully!']);
    }
}
