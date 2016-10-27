<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\UserAuthRequest;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseApiController
{

    public function authenticate(UserAuthRequest $request)
    {
        // Grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // Attempt to verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json(['errors' => ['common'=>['invalid credentials']]], 401);
            }
            $user = \App\User::where('email', $credentials['email'])->first();
            if(! $user->active){
                return response()->json(['errors' => ['common'=>['account not active']]], 401);
            };
            
            //Verify active account
            
        } catch (JWTException $e) {
            // Something went wrong whilst attempting to encode the token
            return response()->json(['errors' => ['common'=>['could not create token']]], 500);
        }
        // All good so return the token
        return response()->json(compact('token'));
    }


    /**
     * Get info about user authenticated user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = \JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

}
