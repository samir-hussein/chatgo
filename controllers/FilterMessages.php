<?php

namespace Controllers;

use App\DataBase;

class FilterMessages
{
    public static function filterRemovedMessages()
    {
        $checkFiles = DataBase::prepare("SELECT m.* FROM messages AS m INNER JOIN chat AS c ON c.id=m.chat_id WHERE (m.deleted_from=c.deleted_from1 AND m.time<c.time2) OR (m.deleted_from=c.deleted_from2 AND m.time<c.time1) OR (m.time<c.time1 AND m.time<c.time2)");

        foreach ($checkFiles as $row) {
            if (!is_null($row->files)) {
                unlink("../public/assets/chatUploads/{$row->files}");
            }
        }


        DataBase::prepare("DELETE m FROM messages AS m INNER JOIN chat AS c ON c.id=m.chat_id WHERE (m.deleted_from=c.deleted_from1 AND m.time<c.time2) OR (m.deleted_from=c.deleted_from2 AND m.time<c.time1) OR (m.time<c.time1 AND m.time<c.time2)");
    }
}
