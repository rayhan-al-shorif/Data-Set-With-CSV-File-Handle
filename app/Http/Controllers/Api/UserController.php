<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userData()
    {
        $users = User::select('id', 'name', 'email', 'phone', 'address', 'created_at')->get();
        return $this->respondWithSuccess('User Data', $users);
    }
}
