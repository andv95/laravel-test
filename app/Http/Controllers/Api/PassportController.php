<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiLoginRequest;
use App\Models\UserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//https://www.laravelcode.com/post/laravel-8-api-authentication-using-passport-from-the-scratch

class PassportController extends ApiBaseController
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = UserApi::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $access_token_example = $user->createToken('PassportExample@Section.io')->access_token;
        //return the access token we generated in the above step
        return  $this->successResponse(['token' => $access_token_example], 'Register successfully');
    }

    public function login(ApiLoginRequest $request)
    {
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($login_credentials)) {
            //generate the token for the user
            $user_login_token = auth()->user()->createToken('PassportExample@Section.io')->accessToken;
            //now return this token on success login attempt
            return  $this->successResponse(['token' => $user_login_token], 'Register successfully');
        }
        //wrong login credentials, return, user not authorised to our system, return error code 401
        return  $this->failResponse('UnAuthorised Access');
    }

    /**
     * This method returns authenticated user details
     */
    public function authenticatedUserDetails()
    {
        //returns details
        return $this->successResponse(['authenticated-user' => Auth::guard('api')->user()]);
    }

    public function logout()
    {
        $user = auth()->user()->token();
        $user->revoke();
        return response()->successResponse(['message' => 'Logout successfully']);
    }
}
