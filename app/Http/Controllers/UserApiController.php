<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public const TOKEN_NAME = 'api';

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $token = auth()->user()->createToken(self::TOKEN_NAME);

            return response()->json($token->plainTextToken);
        }

        //todo throw Invalid Credentials Exception
    }
}
