<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use \Auth;

class ProfileController extends Controller
{
	public function __construct() {
		$this->middleware('auth:api');
	}

    public function me() {
    	$user = Auth::user();

    	return response()->json([
    		'ok' => true,
    		'data' => fractal($user, new UserTransformer)
    	]);
    }
}
