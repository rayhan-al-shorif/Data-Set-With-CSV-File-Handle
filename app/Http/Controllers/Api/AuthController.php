<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Exception;

class AuthController extends Controller
{
    public function userLogin(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->respondWithError("Email and Password are required or not valid", [], 203);
        }

        $user = User::where('email', $request->email)->first();

        // Validator errors
        if (!$user) {
            return $this->respondWithError('User not found');
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken("token");
            Auth::login($user);
            $data = [
                'token' => $token->plainTextToken,
                'user' => $user
            ];
            return $this->respondWithSuccess('Login successfully', $data);
        } else {
            return $this->respondWithError('Password is incorrect');
        }
    }
}
