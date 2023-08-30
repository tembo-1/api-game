<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request):JsonResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $token = auth()->user()->createToken('auth-token');

            return response()->json(['code' => 200, 'token' => $token->plainTextToken]);
        }

        return response()->json(['code' => 403, 'message' => 'Invalid credentials']);
    }
}
