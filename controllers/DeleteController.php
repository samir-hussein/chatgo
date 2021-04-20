<?php

namespace Controllers;

use App\Auth;
use Models\ChatModel;
use Models\MessageModel;

class DeleteController
{
    public function deleteChat($request)
    {
        if (!is_null($request->chat_id)) {
            $check = ChatModel::find($request->chat_id);
            if (is_null($check->deleted_from1) || $check->deleted_from1 == Auth::id()) {
                ChatModel::where(['id', '=', $request->chat_id])->update([
                    'deleted_from1' => Auth::id(),
                    'time1' => date('Y-m-d H:i:s')
                ]);
            } else {
                ChatModel::where(['id', '=', $request->chat_id])->update([
                    'deleted_from2' => Auth::id(),
                    'time2' => date('Y-m-d H:i:s')
                ]);
            }
            echo 'success';
        }
    }

    public function deleteForMe($request)
    {
        if (isset($request->msg_id)) {
            $msg = MessageModel::find($request->msg_id);
            if ($msg && is_null($msg->deleted_from) && ($msg->from_user == Auth::id() || $msg->to_user == Auth::id())) {
                MessageModel::where(['id', '=', $request->msg_id])->update([
                    'deleted_from' => Auth::id(),
                ]);
            } elseif ($msg && !is_null($msg->deleted_from) && $msg->deleted_from != Auth::id() && ($msg->from_user == Auth::id() || $msg->to_user == Auth::id())) {
                if (!is_null($msg->files)) {
                    unlink("../public/assets/chatUploads/{$msg->files}");
                }
                MessageModel::where(['id', '=', $request->msg_id])->delete();
            }
        }
    }

    public function deleteForEveryone($request)
    {
        if (isset($request->msg_id)) {
            $msg = MessageModel::find($request->msg_id);
            if ($msg && $msg->status == 'unread' && $msg->from_user == Auth::id()) {
                if (!is_null($msg->files)) {
                    unlink("../public/assets/chatUploads/{$msg->files}");
                }
                MessageModel::where(['id', '=', $request->msg_id])->delete();
            }
        }
    }
}
