<?php

namespace Controllers;

use App\Auth;
use App\Validatore;
use Models\UserModel;

class LoginController
{
    public function index()
    {
        return view('login');
    }

    public function login($request)
    {
        if (isset($request->signin)) {
            if (!isset($request->remember_me)) {
                $request = editRequest('remember_me', false);
            }
            $valid = Validatore::make([
                'email' => 'required|email',
                'pass' => 'required'
            ]);
            if ($valid) {
                $auth = Auth::attempt($request->email, $request->pass, $request->remember_me);
                if ($auth === true) {
                    return redirect('/');
                } else {
                    $errors = $auth;
                    return view('login', ['errors' => $errors]);
                }
            } else {
                return view('login');
            }
        }
    }
}
