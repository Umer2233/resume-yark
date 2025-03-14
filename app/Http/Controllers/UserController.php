<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Session;
use Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(Request $request)
    {

                try{
                    $user = JWTAuth::parseToken()->authenticate();
                        if($user){
                            JWTAuth::invalidate(JWTAuth::fromUser($user));
                        }
                }catch(\Exception $ex){
                    Log::error($ex->getMessage());
                }

                $request->session()->flush();
                return response()->json('Session destroyed');

    }
}