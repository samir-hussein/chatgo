<?php

namespace Controllers;

use App\Auth;
use App\DataBase;
use Models\ChatModel;

class BlockController
{
    public function block($id, $request)
    {
        $user = Auth::user()->id;
        if (!empty($id)) {
            $check = DataBase::prepare("SELECT * FROM chat WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
        }

        if ($request->unblock == 'true') {
            if ($check[0]->blocked_from1 == $user) {
                DataBase::prepare("UPDATE chat SET blocked_from1=null WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
            } elseif ($check[0]->blocked_from2 == $user) {
                DataBase::prepare("UPDATE chat SET blocked_from2=null WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
            }

            $check = DataBase::prepare("SELECT * FROM chat WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
            if (is_null($check[0]->blocked_from1) && is_null($check[0]->blocked_from2)) {
                DataBase::prepare("UPDATE chat SET block='no' WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
            }
        } else {
            if (!$check) {
                ChatModel::insert([
                    'user1' => $user,
                    'user2' => $id
                ]);
                $check = DataBase::prepare("SELECT * FROM chat WHERE user1=$user AND user2=$id");
            }

            if (is_null($check[0]->blocked_from1)) {
                DataBase::prepare("UPDATE chat SET block='yes',blocked_from1=$user WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
            } else {
                DataBase::prepare("UPDATE chat SET block='yes',blocked_from2=$user WHERE (user1=$id AND user2=$user) OR (user2=$id AND user1=$user)");
            }
        }
        echo $check[0]->id;
    }
}
