<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $rule = [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessageBag()

            ], 422);
        }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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
        if (!Auth::attempt($login)) {
            return response(['message' => 'Sai tài khoản hoặc mật khẩu'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken($user->name);
        return response()->json([
            'user' => $user,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
        ], 200);

    }

    public function changepassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|max:10|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'validation fail',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = $request->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'password successfully updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Old password does not matched'
            ], 400);
        }

    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return $this->isSuccess([], 'logout success');
        }
        return $this->isError('User not exits');
    }

    public function getUserProfileById($id): \Illuminate\Http\JsonResponse
    {
        $user = $this->getUserById($id);
//        return $this->isSuccess($user, 'get user successfully');
        return response()->json([
            'user' => $user,
            'message' => 'get user successfully'
        ]);
    }

    public function updateUser(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = $this->getUserById($id);
        if (!$user) {
            return $this->isError('User not exits');
        }
        $user = DB::table('users')->where('id', $user->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'avatar' => $request->input('avatar'),
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
                'message' => 'Email does not exist'
            ], 200);
        }
        $token = Str::random(10);
        try {


            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now()->addHours(6)
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
        $this->validate($request, [
            'token' => 'required|string',
            'password' => 'required|confirmed'
        ]);
        $token = $request->token;
        $passwordRest = DB::table('password_resets')->where('token', $token)->first();
        if (!$passwordRest) {
            return response(['message' => 'token not found'], 200);
        }
        if (!$passwordRest->created_at >= now()) {
            return response(['message' => 'token has expired'], 200);
        }
        $user = User::where('email', $passwordRest->email)->first();
        if (!$user) {
            return response(['message' => 'user does not exists'], 200);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where('token', $token)->delete();
        return response(['message' => 'Password successfully update'], 200);
    }

}
