<?php

namespace App\Http\Controllers;

use App\Models\UserListing;
use App\Repositories\Interfaces\UserListingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        try{

            $data = [
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'position' => $request->position,
           ];

            $validator = Validator::make($data, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'position' => 'required',
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



    public function destroy($id)
    {
        $this->userListingRepository->destroyUser($id);
        return response()->json(['success' => 'User Deleted Successfully!']);
    }
}
