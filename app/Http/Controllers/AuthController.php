<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\RegisteringRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->firstOrFail();
            if (!Hash::check($request->get('password'), $user->password)) {
                throw new Exception('Invalid password');
            }

            session()->put('name',$user->name);
            $role = strtolower(UserRoleEnum::getKeys($user->role)[0]);
            return redirect()->route("$role.index");
        } catch (Throwable $e) {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registering(RegisteringRequest $request)
    {
        $user = User::query()
            ->create([
                'name'     => $request->get('name'),
                'email'    => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'role'    =>$request->get('role'),
            ]);

        $role = strtolower(UserRoleEnum::getKeys( (int)$request->get('role') )[0] );
        return redirect()->route("$role.index");
    }
}
