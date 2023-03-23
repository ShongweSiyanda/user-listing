<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserListingRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserListingController extends Controller
{
    private UserListingRepositoryInterface $userListingRepository;

    /**
     * Repository Constructor
     * @param UserListingRepositoryInterface $userListingRepository
     */
    public function __construct(UserListingRepositoryInterface $userListingRepository)
    {
        $this->userListingRepository = $userListingRepository;
    }

    /**
     * Get all the user records from the DB table
     * @return Application|Factory|View
     * A list / collection of users and displays it in a table view
     */
    public function index(): View|Factory|Application
    {
        $allUsers = null;
        $errors = null;

        try {
            $allUsers = $this->userListingRepository->listAllUsers();

        } catch (\Exception $PDOException) {
            $errors = $PDOException;
        }

        return view('index',['allUsers' => $allUsers],['errors' => $errors]);
    }


    /**
     * Validates and stores a newly created user in DB Table.
     * @param Request $request
     * @return JsonResponse
     * A response when a record is created, else an error when message or validation error if validation fails.
     */
    public function store(Request $request): JsonResponse
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
     * @return JsonResponse
     * Status of the request - true when record is found and deleted
     */
    public function destroy($id): JsonResponse
    {
        $this->userListingRepository->destroyUser($id);
        return response()->json(['success' => 'User Deleted Successfully!']);
    }
}
