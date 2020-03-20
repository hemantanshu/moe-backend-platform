<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelAccessManager\ImpersonationManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Sys
 */
class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|mixed
     */
    public function validateLogin (Request $request)
    {
        if ( !Auth::attempt(['email' => $request->get('username'), 'password' => $request->get('password')], true) ) {
            return fixed_response(['success' => false, 'reason' => 'Login Failedsss']);
        }

        $user = Auth::user();

        $user->access_object = AccessManager::setUserObject();
        $user->parent_user = ImpersonationManager::getImpersonatingUserSession();

        return success_response($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkLogin (Request $request)
    {
        if ( Auth::check() ) {

            $user = Auth::user();
            $token = 'test';
            $user['oauth_token'] = ['access_token' => $token];
            $user['access_token'] = $token;
            $user['firebase_custom_token'] = 'test';

            return success_response($user);
        }

        return fixed_response(['success' => false, 'reason' => 'No Logged User']);
    }
}
