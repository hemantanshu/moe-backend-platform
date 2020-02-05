<?php

namespace App\Http\Controllers;

use Drivezy\LaravelAccessManager\AccessManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function test ()
    {
        Auth::logout();
        Auth::loginUsingId(1, true);
        AccessManager::setUserObject();
        return AccessManager::getUserObject();
        return success_response('seems all good till now!');
    }
}
