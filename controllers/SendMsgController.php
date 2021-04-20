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
                    'user2' => $request->user_id,
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
                'oldName' => null,
            ]);

            echo $newChat[0]->id;
        }
    }

    public function file($request)
    {
        $validate = Validatore::make([
            'chat_id' => 'required',
            'user_id' => 'required',
        ]);

        if (!$validate || empty($request->files->name[0])) {
            echo "error";
        } else {
            $newChat = ChatModel::where(['id', '=', $request->chat_id])->get();
            if (!$newChat) {
                ChatModel::insert([
                    'user1' => Auth::user()->id,
                    'user2' => $request->user_id,
                ]);
                $newChat = ChatModel::orderBy('id', 'desc')->first();
            } else {
                if ($newChat[0]->block == 'yes') {
                    echo $newChat[0]->id;
                    exit;
                }
            }

            $allowedExt = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'mp4', 'mp3', 'm4a', 'oga', 'ogg', 'ogv', 'aac', 'avi', 'pdf', 'doc', 'docx', 'webm', 'mkv', 'xls', 'xlsx', 'txt');
            $files = Validation::files('files', 1010000000, $allowedExt, 'assets/chatUploads/', 'CG_');

            if ($files != 1 || $files != 2 || $files != 3 || $files != 4) {
                $i = 0;
                foreach ($files as $file) {
                    MessageModel::insert([
                        'from_user' => Auth::user()->id,
                        'to_user' => $request->user_id,
                        'body' => null,
                        'c1' => null,
                        'c2' => null,
                        'c3' => null,
                        'chat_id' => $newChat[0]->id,
                        'files' => $file['name'],
                        'oldName' => str_replace('-', '_', $request->files->name[$i]),
                    ]);
                    $i++;
                }
                echo $newChat[0]->id;
            } else {
                echo 'error';
            }
        }
    }

    public function record($request)
    {
        $validate = Validatore::make([
            'chat_id' => 'required',
            'user_id' => 'required',
        ]);

        if (!$validate || empty($request->audio_data->name)) {
            echo "error";
        } else {
            $newChat = ChatModel::where(['id', '=', $request->chat_id])->get();
            if (!$newChat) {
                ChatModel::insert([
                    'user1' => Auth::user()->id,
                    'user2' => $request->user_id,
                ]);
                $newChat = ChatModel::orderBy('id', 'desc')->first();
            } else {
                if ($newChat[0]->block == 'yes') {
                    echo $newChat[0]->id;
                    exit;
                }
            }

            $allowedExt = array('wav');
            $record = Validation::file('audio_data', $allowedExt, 'assets/chatUploads/', 'CG_');
            if ($record != 1 || $record != 2 || $record != 3) {
                MessageModel::insert([
                    'from_user' => Auth::user()->id,
                    'to_user' => $request->user_id,
                    'body' => null,
                    'c1' => null,
                    'c2' => null,
                    'c3' => null,
                    'chat_id' => $newChat[0]->id,
                    'files' => $record['name'],
                    'oldName' => null,
                ]);
                echo $newChat[0]->id;
            } else {
                echo "error";
            }
        }
    }
}
