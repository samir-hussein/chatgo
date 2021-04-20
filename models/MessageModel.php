<?php

namespace Models;

use App\DataBase;

class MessageModel extends DataBase
{
    public function __construct()
    {
        self::$tableName = 'messages';
        self::$columnNames = ['from_user', 'to_user', 'chat_id', 'body', 'files', 'c1', 'c2', 'c3', 'oldName'];
    }
}
