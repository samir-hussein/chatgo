<?php

namespace Controllers;

use App\Auth;
use Models\UserModel;

class UserStatus
{
    public static function online()
    {
        UserModel::where(['id', '=', Auth::user()->id])->update([
            'status' => "Active now"
        ]);
    }

    public static function offline()
    {
        UserModel::where(['id', '=', Auth::user()->id])->update([
            'status' => date('Y-m-d H:i a')
        ]);
    }
}
