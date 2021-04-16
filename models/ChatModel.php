<?php

namespace Models;

use App\DataBase;

class ChatModel extends DataBase
{
    public function __construct()
    {
        self::$tableName = 'chat';
        self::$columnNames = ['user1', 'user2'];
    }
}
