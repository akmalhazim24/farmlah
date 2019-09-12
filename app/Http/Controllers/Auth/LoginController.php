<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use \Auth;

class LoginController extends Controller {
    /**
     * TeaLive is awesome
     */
    public function __invoke(LoginRequest $request) {
        $credentials = $request->only(['email','password']);

        $token = Auth::attempt($credentials);
        if(!$token) {
        	// abort request
        	abort(401, 'Wrong email and/or password');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}