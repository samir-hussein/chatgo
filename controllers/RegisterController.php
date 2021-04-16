<?php

namespace Controllers;

use App\Auth;
use App\Session;
use App\DataBase;
use App\Validation;
use App\Validatore;
use Models\ChatModel;
use Models\UserModel;
use Models\MessageModel;

class RegisterController
{
    public function index()
    {
        return view('register');
    }

    public function create($request)
    {
        if (isset($request->signup)) {
            $valid = Validatore::make([
                'name' => 'required',
                'email' => 'required|email|unique:UserModel',
                'phone' => 'required|num|unique:UserModel',
                'pass' => 'required|same:re_pass'
            ]);

            if ($valid) {
                $create = UserModel::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => password_hash($request->pass, PASSWORD_DEFAULT)
                ]);

                if ($create) {
                    Session::flash('success', 'created successfully now you can login');
                    $user_id = UserModel::where(['email', '=', $request->email])->get(['id']);
                    $user_id = $user_id[0]->id;
                    $chatgo = UserModel::where(['email', '=', 'chatgo@gmail.com'])->get(['id']);
                    $chatgo = $chatgo[0]->id;
                    ChatModel::insert([
                        'user1' => $chatgo,
                        'user2' => $user_id,
                    ]);
                    $chat_id = DataBase::prepare("SELECT id FROM chat WHERE user1=$chatgo AND user2=$user_id");
                    $welcomeMsg = "Welcome in Chat go. Now you can chat with your friends savely.
You can contact with us here for technical support.";
                    $arr = encryptMessage($welcomeMsg);
                    MessageModel::insert([
                        'from_user' => $chatgo,
                        'to_user' => $user_id,
                        'body' => $arr['ciphertext'],
                        'c1' => utf8_encode($arr['iv']),
                        'c2' => utf8_encode($arr['key']),
                        'c3' => utf8_encode($arr['tag']),
                        'chat_id' => $chat_id[0]->id,
                        'files' => null,
                    ]);
                    return redirect("/login");
                } else {
                    Session::flash('error', 'something went wrong');
                    return redirect('/register');
                }
            } else {
                return view('register');
            }
        }
    }
}
