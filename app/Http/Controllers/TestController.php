<?php

namespace App\Http\Controllers;

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

        Auth::loginUsingId(1, true);
        return success_response('seems all good till now!');
    }
}
