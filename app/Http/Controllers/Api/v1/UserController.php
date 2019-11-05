<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response([
                'data' => 'اطلاعات صحیح نمی باشد',
                'status' => 'error'
            ], 403);
        }

        \auth()->user()->update([
            'api_token' => Str::random(100)
        ]);

        $user = \auth()->user();

        return new User($user);

    }

    public function register(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = \App\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => Str::random(100)
        ]);

        return new User($user);

    }
}
