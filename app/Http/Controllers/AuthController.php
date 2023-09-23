<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users',
                'password' => 'required|string',
                'c_password' => 'required|same:password',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Registration successful',
                'accessToken' => $token,
            ], 201);
        } catch (Exception $e) {
            Log::error("Error in AuthController register() " . $e->getMessage());

            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        try {

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'accessToken' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (Exception $e) {
            Log::error("Error in AuthController login() " . $e->getMessage());

            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
