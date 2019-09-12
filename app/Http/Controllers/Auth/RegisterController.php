<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request) {
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    		'role' => $request->role
    	]);

    	return response()->json([
    		'ok' => true,
    		'message' => 'Successfully registered user'
    	]);
    }
}
