<?php

namespace Controllers;

use App\Auth;
use App\Validation;
use App\Validatore;
use Models\ChatModel;
use Models\MessageModel;

class SendMsgController
{
    public function msg($request)
    {
        $validate = Validatore::make([
            'chat_id' => 'required',
            'user_id' => 'required',
        ]);

        if (!$validate || empty(trim($request->msg))) {
            echo "error";
        } else {
            $newChat = ChatModel::where(['id', '=', $request->chat_id])->get();
            if (!$newChat) {
                ChatModel::insert([
                    'user1' => Auth::user()->id,
                    'user2' => $request->user_id
                ]);
                $newChat = ChatModel::orderBy('id', 'desc')->first();
            } else {
                if ($newChat[0]->block == 'yes') {
                    echo $newChat[0]->id;
                    exit;
                }
            }

            $arr = encryptMessage($request->msg);

            MessageModel::insert([
                'from_user' => Auth::user()->id,
                'to_user' => $request->user_id,
                'body' => $arr['ciphertext'],
                'c1' => utf8_encode($arr['iv']),
                'c2' => utf8_encode($arr['key']),
                'c3' => utf8_encode($arr['tag']),
                'chat_id' => $newChat[0]->id,
                'files' => null,
            ]);

            echo $newChat[0]->id;
        }
    }

    public function file($request)
    {
        $allowedExt = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'mp4', 'mp3', 'avi', 'pdf', 'doc', 'docx', 'webm', 'mkv', 'xls', 'xlsx', 'txt');
        $arr = Validation::files('files', 1000000000, $allowedExt, 'assets/chatUploads/');

        var_dump($arr);
    }
}
