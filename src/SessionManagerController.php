<?php

namespace Jetiradoro\SessionManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\Resource;
use Jetiradoro\SessionManager\Models\Session;

class SessionManagerController extends Controller
{
    /**
     * show main view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('session-manager::index');
    }

    /**
     * Get all innactive users connected
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function connections()
    {
        $users = Session::connected()->get();
        return Resource::collection($users);
    }

    /**
     * Destroy all sessions from user
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroySession($user_id)
    {
        try {
            if (Session::where('user_id',$user_id)->delete()) {
                return response()->json(['status' => config('session-manager.success_msg')]);
            } else {
                return response()->json(['status' => 'fail', 'message' => config('session-manager.error_msg')]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => config('session-manager.error_msg')]);
        }
    }
}
