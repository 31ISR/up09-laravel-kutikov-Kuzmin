<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show() {
        return view('auth.register');
    }

    public function store(Request $request) {
        // валидируйте поля в переменную data
        // name - обязательная стринга макс размер 255
        // email - обязательное мыло уникальное
        // для таблы юзеров
        // пароль - обязательная стринга минимум 8 
        // символов с подтверждением
        $data = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:8|confirmed"
        ]);
        
        $user = User::create([
            ...$data,
            'password' => bcrypt($data['password'])
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
