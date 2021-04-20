<?php

namespace Controllers;

use App\Auth;
use App\DataBase;
use Models\ChatModel;
use Models\MessageModel;

class AllChatController
{
    public function AllChat()
    {
        $me = Auth::user()->id;
        $result = MessageModel::where(['from_user', '=', $me])->orWhere(['to_user', '=', $me])->orderBy('id', 'desc')->get(['chat_id']);
        if (is_null($result)) {
            echo json_encode('no result');
        } else {
            $result = array_column($result, 'chat_id');
            $result = array_unique($result);
            $finalArray = [];
            foreach ($result as $value) {
                $finalArray[]['chat_id'] = $value;
            }
            $result = $finalArray;
            $response = [];
            for ($i = 0; $i < count($result); $i++) {
                $chat = ChatModel::find($result[$i]['chat_id']);

                if ($chat->deleted_from1 == Auth::id()) {
                    $time = $chat->time1;
                } else {
                    $time = ($chat->time2);
                }

                if (!is_null($time)) {
                    $check = MessageModel::where(['chat_id', '=', $result[$i]['chat_id']])->where(['time', '>', $time])->orderBy('id')->get();
                } else {
                    $check = null;
                }

                if (!is_null($check) || is_null($time)) {
                    $to_user = MessageModel::where(['chat_id', '=', $result[$i]['chat_id']])->orderBy('id', 'desc')->get(['to_user']);
                    $msgNum = MessageModel::where(['chat_id', '=', $result[$i]['chat_id']])->where(['status', '=', 'unread'])->countRows();
                    $res = DataBase::prepare("SELECT id,name,email,phone,status,image,is_type,is_recording FROM users WHERE (id = " . $chat->user1 . " OR id = " . $chat->user2 . ") AND id != $me");

                    if (!is_null($res[0]->is_type) && $res[0]->is_type == $chat->id) {
                        $res[0] = addProperty($res[0], 'status', 'typing...');
                    }
                    if (!is_null($res[0]->is_recording) && $res[0]->is_recording == $chat->id) {
                        $res[0] = addProperty($res[0], 'status', 'recording...');
                    }
                    $res[0] = addProperty($res[0], 'chat_id', $chat->id);
                    $res[0] = addProperty($res[0], 'block', $chat->block);
                    $res[0] = addProperty($res[0], 'msgNum', $msgNum);
                    $res[0] = addProperty($res[0], 'to_user', $to_user[0]->to_user);
                    $res[0]->name = htmlspecialchars($res[0]->name);
                    $response = array_merge($response, $res);
                }
            }
            echo json_encode($response);
        }
    }
}
