<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:10|numeric'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);
        return $this->isSuccess($user, 'create user successfully');
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return $this->isSuccess($token, 'login successfully');
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response(['message' => 'You have been successfully logged out.'], 200);
        }
        return $this->isError('User not exits');
    }

    public function getUserProfileById($id): \Illuminate\Http\JsonResponse
    {
        $user = $this->getUserById($id);
        return response()->json(['user' => $user], 200);
    }

    public function updateUser(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = $this->getUserById($id);
        if (!$user) {
            return $this->isError('User not exits');
        }
        $user = User::update([
            'name' => $request->name,
            'phone' => $request->phone,
            'updated_at' => now()
        ]);
        return $this->isSuccess($user, 'update user successfully');
    }

    private function getUserById($id)
    {
        return User::where('id', $id)->first();
    }

    private function isSuccess($data, $message): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => true, 'data' => $data, 'message' => $message]);
    }

    private function isError($message): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => false, 'data' => [], 'message' => $message]);
    }
}
