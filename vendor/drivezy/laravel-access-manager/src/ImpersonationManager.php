<?php

namespace Drivezy\LaravelAccessManager;

use Drivezy\LaravelAccessManager\Models\ImpersonatingUser;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Library\DateUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class ImpersonationManager
 * @package Drivezy\LaravelAccessManager
 */
class ImpersonationManager
{
    /**
     * @param $userId
     * @return bool|JsonResponse
     */
    public static function impersonateUser ($userId)
    {
        if ( !Auth::check() ) return false;

        $parentUser = Auth::user();

        //set new user login
        Auth::loginUsingId($userId, true);

        $record = ImpersonatingUser::create([
            'parent_user_id'        => $parentUser->id,
            'impersonating_user_id' => $userId,
            'session_identifier'    => session()->getId(),
            'start_time'            => DateUtil::getDateTime(),
        ]);

        return $record;
    }

    /**
     * @return bool
     */
    public static function deImpersonateUser ()
    {
        if ( !Auth::check() ) return false;

        //check if the user is impersonating
        $record = ImpersonatingUser::active()
            ->where('session_identifier', session()->getId())
            ->where('impersonating_user_id', Auth::id())
            ->first();
        if ( !$record ) return false;

        //add end time to the user
        $record->end_time = DateUtil::getDateTime();
        $record->save();

        //login the main user
        Auth::loginUsingId($record->parent_user_id, true);

        return $record;
    }

    /**
     * @return array|mixed
     */
    public static function getImpersonatingUserSession ()
    {
        if ( !Auth::check() ) return [];

        $record = ImpersonatingUser::active()
            ->where('session_identifier', session()->getId())
            ->where('impersonating_user_id', Auth::id())
            ->first();

        if ( !$record ) return [];

        $userClass = LaravelUtility::getUserModelFullQualifiedName();

        return $userClass::find($record->parent_user_id);
    }

    /**
     * get the actual user who is logged into the system
     * @return array
     */
    public static function getActualLoggedUser ()
    {
        if ( !Auth::check() ) return [];

        $record = ImpersonatingUser::active()
            ->where('session_identifier', session()->getId())
            ->where('impersonating_user_id', Auth::id())
            ->first();

        if ( !$record ) return Auth::user();

        $userClass = LaravelUtility::getUserModelFullQualifiedName();

        return $userClass::find($record->parent_user_id);
    }
}
