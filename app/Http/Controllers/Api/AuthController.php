<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;;

use App\Http\Requests\Api\UserSignUpRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(UserLoginRequest $request)
    {
        if (!$jwt_token = JWTAuth::attempt($request->validated(), ['exp' => Carbon::now()->addDays(7)->timestamp])) {
            return msg(false,  trans('lang.phoneOrPasswordIncorrect'), failed());
        } else {
            $user = JWTAuth::user();

            $data = (new UserResource($user))->token($jwt_token);
            return msgdata(true, trans('lang.login_s'), $data, success());
        }
    }

    public function signUp(UserSignUpRequest $request)
    {
        $request = $request->validated();
        $user = User::create($request);
//        $user->token = JWTAuth::fromUser($user);
        $data = (new UserResource($user))->token(JWTAuth::fromUser($user));
        return msgdata(true, trans('lang.login_s'), $data, success());

    }

    public function logout()
    {
        $forever = true;
        JWTAuth::parseToken()->invalidate($forever);
        return msg(true, trans('lang.success'), success());
    }

}

