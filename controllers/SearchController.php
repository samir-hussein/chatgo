<?php

namespace Controllers;

use App\Auth;
use App\DataBase;

class SearchController
{
    public function search($request)
    {
        if (isset($request->text_search) && !empty(trim($request->text_search))) {
            $result = DataBase::prepare("SELECT id, name, email, phone,status,image FROM users WHERE id!= " . Auth::user()->id . " AND (email LIKE '%$request->text_search%' OR phone LIKE '%$request->text_search%')");

            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $chat_id = DataBase::prepare("SELECT id,block FROM chat WHERE (user1=" . $result[$i]->id . " OR user2=" . $result[$i]->id . ") AND (user1=" . Auth::user()->id . " OR user2=" . Auth::user()->id . ")");
                    $result[$i] = addProperty($result[$i], 'chat_id', ($chat_id[0]->id) ?? null);
                    $result[$i] = addProperty($result[$i], 'block', ($chat_id[0]->block) ?? null);
                    $result[$i]->name = htmlspecialchars($result[$i]->name);
                }
                echo json_encode($result);
            }
        } else {
            echo json_encode("no result");
        }
    }
}
