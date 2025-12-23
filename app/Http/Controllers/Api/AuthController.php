<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate البيانات
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // إنشاء User
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),

        ]);

        // إنشاء Token باستخدام Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // إرجاع JSON منظم
        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ], 201);
    }


    public function login(Request $request)
    {
        // Validate البيانات
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // التحقق من البريد وكلمة المرور
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        // إصدار Token
        $token = $user->createToken('auth_token')->plainTextToken;

        // إرجاعه للـ Client
        return response()->json([
            'message' => 'User logged in successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }


    public function logout(Request $request)
    {
        // حذف Token الحالي
        $request->user()->currentAccessToken()->delete();

        // أو حذف كل Tokens
        // $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'User logged out successfully'
        ], 200);
    }
}
