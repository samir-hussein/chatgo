<?php

namespace Controllers;

use App\Auth;
use Models\ChatModel;
use Models\UserModel;

class TypeStatusController
{
    public function focus($chat_id)
    {
        $check = ChatModel::find($chat_id);
        if ($check) {
            UserModel::where(['id', '=', Auth::id()])->update([
                'is_type' => $chat_id
            ]);
        }
    }

    public function focusout()
    {
        UserModel::where(['id', '=', Auth::id()])->update([
            'is_type' => null
        ]);
    }

    public function startRecord($chat_id)
    {
        $check = ChatModel::find($chat_id);
        if ($check) {
            UserModel::where(['id', '=', Auth::id()])->update([
                'is_recording' => $chat_id
            ]);
        }
    }
    public function stopRecord()
    {
        UserModel::where(['id', '=', Auth::id()])->update([
            'is_recording' => null
        ]);
    }
}
