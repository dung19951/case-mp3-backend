<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $login = $request->only('email', 'password');

        if (!Auth()->attempt($login)) {
            return response()->json(['message' => 'Invalid login credential!'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken($user->name);
        return response()->json([
            'user'=>$user,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
        ], 200);
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
        return $this->isSuccess($user, 'get user successfully');
    }

    public function updateUser(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = $this->getUserById($id);
        if (!$user) {
            return $this->isError('User not exits');
        }
        $user = DB::table('users')->where('id', $user->id)->update([
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

    public function forgot(ForgotRequest $request)
    {
        $email = $request->input('email');
        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'User doen\'t exist'
            ], 404);
        }
        $token = Str::random(10);
        try {


            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);
            Mail::send('emails.forgot', ['token' => $token], function (\Illuminate\Mail\Message $message) use ($email) {
                $message->to($email);
                $message->subject('Reset your password');
            });
            return response([
                'message' => 'check your email'
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function reset(Request $request)
    {
        $token = $request->input('token');
        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'Invalid token'
            ], 400);
        }

        if (!$user = User::where('email', $passwordResets->email)->first()) {
            return response([
                'message' => 'User doesn\'t exist'
            ], 400);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response([
            'message' => 'success'
        ]);
    }

}
