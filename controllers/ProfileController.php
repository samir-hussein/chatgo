<?php

namespace Controllers;

use App\Auth;
use App\DataBase;
use Models\UserModel;

class ProfileController
{
    public function index($id)
    {
        $chatGo = UserModel::where(['email', '=', "chatgo@gmail.com"])->get(['id'])[0];
        $user = UserModel::where(['id', '=', $id])->get(['about', 'name', 'email', 'phone', 'image', 'only_me'])[0];

        $me = Auth::user()->id;

        if ($user && $user->only_me == 'no' && $id != $me && $id != $chatGo->id) {

            $checkBlock = DataBase::prepare("SELECT id,block FROM chat WHERE (user1=$id AND user2=$me) OR (user2=$id AND user1=$me)");

            if (($checkBlock && $checkBlock[0]->block == 'no') || is_null($checkBlock)) {
                $userInfo = [
                    'name' => htmlspecialchars($user->name),
                    'email' => htmlspecialchars($user->email),
                    'phone' => htmlspecialchars($user->phone),
                    'image' => htmlspecialchars($user->image),
                    'about' => htmlspecialchars($user->about),
                ];
                echo json_encode($userInfo);
            } else {
                echo json_encode("refused");
            }
        } else {
            echo json_encode("refused");
        }
    }

    public function myProfile()
    {
        $user = UserModel::where(['id', '=', Auth::user()->id])->get(['image', 'phone', 'about', 'name', 'email', 'only_me'])[0];
        if ($user->only_me == 'yes') {
            $only_me = 'lock';
        } else {
            $only_me = 'unlock';
        }
        $userInfo = [
            'id' => Auth::user()->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image,
            'phone' => $user->phone,
            'about' => $user->about,
            'only_me' => $only_me,
        ];

        return view('myprofile', $userInfo);
    }
}
