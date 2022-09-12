<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

//https://www.laravelcode.com/post/laravel-8-api-authentication-using-passport-from-the-scratch

class PassportController extends ApiBaseController
{
    /**
     * @OA\Post(
     *     path="/v1/register",
     *     tags={"user"},
     *     summary="Add a new user to the store",
     *     description="Returns a single new user.",
     *     operationId="createUser",
     *     @OA\RequestBody(
     *          description= "User object that needs to be added to the store",
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string")
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid id supplied",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="The specified data is invalid."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  example={
     *                      "name": "Name field is required.",
     *                      "email": "Email field is required.",
     *                      "password": "Password field is required.",
     *                  },
     *              ),
     *         ),
     *     ),
     * )
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //$access_token_example = $user->createToken('Api Token')->access_token;
        //return the access token we generated in the above step
        return  $this->successResponse(['user' => $user], 'Register successfully');
    }

    /**
     * @OA\Post(
     *     path="/v1/login",
     *     tags={"user"},
     *     summary="Login admin",
     *     description="Returns a accesstoken",
     *     operationId="login",
     *     @OA\RequestBody(
     *          description= "Email and password to login",
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string")
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string"),
     *              @OA\Property(property="token_type", type="string"),
     *              @OA\Property(property="expires_at", type="date"),
     *          )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid id supplied",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="The given data was valid."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  example={
     *                      "email": "Email is required.",
     *                      "password": "Password is required.",
     *                  },
     *              ),
     *         ),
     *     ),
     * )
     */
    public function login(ApiLoginRequest $request)
    {
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($login_credentials)) {
            //generate the token for the user
            $tokenResult = auth()->user()->createToken('API Token');
            $user_login_token = $tokenResult->accessToken;
            //now return this token on success login attempt
            if ($request->remember_me) {
                $user_login_token->expires_at = Carbon::now()->addWeeks(1);
            }

            return  $this->successResponse([
                'token' => $user_login_token,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ], 'Register successfully');
        }
        //wrong login credentials, return, user not authorised to our system, return error code 401
        return  $this->failResponse('UnAuthorised Access');
    }

    /**
     * @OA\Get(
     *     path="/v1/user",
     *    tags={"user"},
     *     summary="Get current user",
     *     operationId="getCurrentUser",
     *     description="Returns a current user.",
     *     security={
     *           {"bearer_token": {}}
     *       },
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User not found."
     *              ),
     *         ),
     *     ),
     * )
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
