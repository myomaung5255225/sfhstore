<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\AuthRepo;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(AuthRepo $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function users(Request $request)
    {
        $returnObj = $this->authRepo->users($request);
        return response()->json($returnObj);
    }

    public function user(Request $request)
    {
        $returnObj = $this->authRepo->user($request);
        return response()->json($returnObj);
    }

    public function login(Request $request)
    {
        $returnObj = $this->authRepo->login($request);
        return response()->json($returnObj);
    }
    public function register(Request $request)
    {
        $returnObj = $this->authRepo->register($request);
        return response()->json($returnObj);
    }

    public function updateUser(Request $request, $id)
    {
        $returnObj = $this->authRepo->updateUser($request, $id);
        return response()->json($returnObj);
    }

    public function deleteUser($id)
    {
        $returnObj = $this->authRepo->deleteUser($id);
        return response()->json($returnObj);
    }

    public function passwordReset(Request $request){
        $returnObj = $this->authRepo->passwordReset($request);
        return response()->json($returnObj);
    }
}
