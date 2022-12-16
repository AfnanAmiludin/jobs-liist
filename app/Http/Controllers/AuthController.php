<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $user = User::get();

        return response()->json(['data' => $user]);
    }

    public function create(Request $request)
    {
        $attribute = $request->validate([
            'username' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create($attribute);

        return response()->json(['data' => $user]);
    }

    public function show(User $user)
    {
        return response()->json(['data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $attribute = $request->validate([
            'username' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user->update($attribute);

        return response()->json(['data' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['data' => $user]);
    }

    public function register(Request $request)
    {
        $attribute = $request->validate([
            'username' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $attribute['password'] = Hash::make($request->password);

        $user = User::create($attribute);

        if ($user) {
            return response()->json([
                'Data' => $user,
                'Message' => 'Anda berhasil regis',
                'Status' => 200
            ]);
        } else {
            return response()->json([
                'Message' => 'Anda gagal register, Mohon coba lagi',
                'Status' => 400
            ], abort(403));
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'Message' => 'Anda gagal melakukan login!!!',
                'Status' => 400
            ], abort(403));
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        if ($token) {
            return response()->json([
                'message' => 'Anda Berhasil Login',
                'Status' => 200,
                'Acces_token' => $token,
                'Token_type' => 'Bearer'
            ]);
        } else {
            return response()->json([
                'message' => 'Anda Gagal Login, Silahkan coba lagi',
                'Status' => 400,
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'Message' => 'Anda berhasil logout!!!',
            'Status' => 200
        ]);
    }
}
