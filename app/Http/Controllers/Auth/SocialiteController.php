<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Socialite;

class SocialiteController extends Controller
{
	protected $provider;

	public function __construct(Request $request) {
		$this->provider = $request->query('provider');
	}

	/**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
    	$this->validateProvider();
        return Socialite::driver($this->provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
    	$this->validateProvider();
    	try {
        	$user = Socialite::driver($this->provider)->stateless()->user();
    	} catch(\Exception $err) {
    		return response()->json([
    			'ok' => false,
    			'error' => 'Unable to verify user' 
    		]);
    	}

        dd($user);
    }

    protected function validateProvider() {
    	if(!in_array($this->provider, ['google','facebook'])) {
    		abort(400, 'Social auth provider not found');
    	}
    }
}
