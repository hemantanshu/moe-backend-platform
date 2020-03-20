<?php

namespace App\Http\Controllers\Sys;

use App\Models\Sys\UserPreference;
use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Sys
 */
class UserPreferenceController extends RecordController
{
    /**
     * @var string
     */
    protected $model = UserPreference::class;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserPreference (Request $request)
    {
        if ( $request->has('parameters') )
            return $this->getUserPreferences();

        $query = $request->has('parameter') ? "parameter = '" . $request->get('parameter') . "'" : " id = id ";

        if ( $request->has('parameter') ) {
            $obj = UserPreference::where('user_id', '=', Auth::user()->id)
                ->whereRaw($query)
                ->first();
            if ( !$obj ) {
                $obj = UserPreference::whereNull('user_id')
                    ->whereRaw($query)
                    ->first();
            }
        } else {
            $obj = UserPreference::where('user_id', '=', Auth::user()->id)
                ->whereRaw($query)
                ->get();
        }

        return success_response($obj);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserPreferences (Request $request)
    {
        $parameters = explode(',', $request->get('parameters'));
        $query = '(user_id is null or user_id = ' . Auth::user()->id . ') and parameter in (';
        $first = true;
        foreach ( $parameters as $parameter ) {
            if ( $first )
                $query .= "'$parameter'";
            else
                $query .= ",'$parameter'";

            $first = false;
        }
        $query .= ')';

        $data = UserPreference::whereRaw($query)->orderBy('user_id', 'asc')->get();
        $response = [];
        foreach ( $data as $item ) {
            $response[ $item->parameter ] = $item->value;
        }

        return success_response($response);
    }

    /**
     * @return JsonResponse
     */
    public function setUserPreference (Request $request)
    {
        $userRoles = AccessManager::getUserObject()->roles;
        if ( in_array(1, $userRoles) ) {
            if ( $request->has('override_all') && $request->get('override_all') ) {
                return Response::json(['success' => true, 'response' => $this->setGlobalPreference($request)]);
            }
        }

        return success_response($this->setIndividualPreference($request));
    }

    /**
     * @param Request $request
     * @return UserPreference
     */
    private function setGlobalPreference (Request $request)
    {
        $param = $request->get('parameter');

        UserPreference::where('user_id', Auth::user()->id)->where('parameter', $param)->forceDelete();
        $obj = UserPreference::where('parameter', $param)->whereNull('user_id')->first();
        if ( !$obj )
            $obj = new UserPreference();

        $obj->parameter = $param;
        $obj->value = $request->get('value');
        $obj->save();

        return $obj;
    }

    /**
     * @param Request $request
     * @return UserPreference
     */
    private function setIndividualPreference (Request $request)
    {
        $param = $request->get('parameter');
        $obj = UserPreference::where('parameter', $param)->where('user_id', Auth::user()->id)->first();
        if ( !$obj )
            $obj = new UserPreference();

        $obj->parameter = $request->get('parameter');
        $obj->value = $request->get('value');
        $obj->user_id = Auth::user()->id;
        $obj->save();

        return $obj;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUserPreference (Request $request)
    {
        $userRoles = AccessManager::getUserObject()->roles;
        if ( in_array(1, $userRoles) ) {
            if ( $request->has('override_all') && $request->get('override_all') ) {
                $res = $this->deleteGlobalPreference();

                return Response::json(['success' => $res['success'], 'response' => $res['response']]);
            }
        }
        $res = $this->deleteIndividualPreference($request);

        return Response::json(['success' => $res['success'], 'response' => $res['response']]);
    }

    /**
     * @return array
     */
    private function deleteGlobalPreference (Request $request)
    {
        $param = $request->get('parameter');
        $obj = UserPreference::where('parameter', $param)->whereNull('user_id')->first();

        if ( $obj ) {
            $obj->forceDelete();

            return ['success' => true, 'response' => $obj];
        }

        return ['success' => false, 'response' => "No such preference exists."];
    }

    /**
     * @return array
     */
    private function deleteIndividualPreference (Request $request)
    {
        $param = $request->get('parameter');
        $userId = $request->has('user_id') ? $request->get('user_id') : Auth::user()->id;
        $obj = UserPreference::where('parameter', $param)->where('user_id', $userId)->first();
        if ( $obj ) {
            $obj->forceDelete();

            return ['success' => true, 'response' => $obj];
        }

        return ['success' => false, 'response' => "You don't have this preference set."];
    }
}
