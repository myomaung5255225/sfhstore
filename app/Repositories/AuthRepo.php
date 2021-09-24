<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Ramsey\Uuid\Rfc4122\UuidV4;

//use Your Model

/**
 * Class AuthRepo.
 */
class AuthRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function users($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $users = User::orderBy('updated_at', 'desc')->paginate($request->limit ?? 10);
            $returnObj['users'] = $users;
            $returnObj['message'] = 'success';
            $returnObj['statusCode'] = 200;
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function user($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $user = $request->user();
            $returnObj['user'] = $user;
            $returnObj['message'] = 'success';
            $returnObj['statusCode'] = 200;
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function login($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [

                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                $user = User::where('email', $request['email'])->first();
                if ($user) {
                    if (Hash::check($request['password'], $user->password)) {
                        $accessToken =  $user->createToken('access_token')->accessToken;
                        $returnObj['user'] = $user;
                        $returnObj['access_token'] = $accessToken;
                        $returnObj['statusCode'] = 200;
                    } else {
                        $returnObj['message'] = 'Your password does not match!';
                        $returnObj['statusCode'] = 422;
                    }
                } else {
                    $returnObj['message'] = 'User does not exist';
                    $returnObj['statusCode'] = 422;
                }
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function register($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                $request['password'] = Hash::make($request['password']);
                $request['remember_token'] = UuidV4::getFactory();
                $user = User::create($request->toArray());
                $accessToken = $user->createToken('access_token')->accessToken;
                $returnObj['user'] = $user;
                $returnObj['access_token'] = $accessToken;
                $returnObj['statusCode'] = 201;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function updateUser($request, $id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->save();
                if ($user) {
                    $returnObj['user'] = $user;
                    $returnObj['message'] = 'User updated successfully!';
                    $returnObj['statusCode'] = 200;
                } else {

                    $returnObj['message'] = 'User updated fail!';
                    $returnObj['statusCode'] = 400;
                }
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }
    public function deleteUser($id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $user = User::findOrFail($id);

            $user->delete();
            if ($user) {
                $returnObj['user'] = $user;
                $returnObj['message'] = 'User deleted successfully!';
                $returnObj['statusCode'] = 200;
            } else {

                $returnObj['message'] = 'User deleted fail!';
                $returnObj['statusCode'] = 400;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function passwordReset($request){
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
             $validator = Validator::make($request->all(),[
                'email'=>'required|email'
             ]);
             if($validator->fails()){
                $returnObj['statusCode']=422;
                $returnObj['errors']=$validator->errors();
             }
             else{
                $status = Password::sendResetLink($request->only('email'));
                $returnObj['status']=$status;
                $returnObj['statusCode']=200;
             }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }
}
