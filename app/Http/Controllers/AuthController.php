<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the FB auth page
     *
     * @return Response
     */
    public function redirectToProvider()
    {
    	return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from FB
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            try {
            	$user = Socialite::driver('facebook')->user();
            } catch (\Exception $e) {
                abort(500);
            }

            $userInfo = array();
            $userInfo['name'] = $user->getName();
            $userInfo['email'] = $user->getEmail();
            $userInfo['avatarUrl'] = $user->getAvatar();
            $userinfo['facebookId'] = $user->getId();

            return $userInfo;

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
