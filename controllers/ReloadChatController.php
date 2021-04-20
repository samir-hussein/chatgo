<?php

namespace Controllers;

use App\Auth;
use App\Session;
use App\DataBase;
use Models\ChatModel;
use Models\UserModel;
use Models\MessageModel;

class ReloadChatController
{
    public function reloadChat($request)
    {
        $time = null;
        $chatModel = ChatModel::find($request->chatId);
        if ($chatModel && $chatModel->deleted_from1 == Auth::id()) {
            $time = $chatModel->time1;
        } elseif ($chatModel) {
            $time = $chatModel->time2;
        }

        if ($chatModel && $chatModel->user1 == Auth::id()) {
            $lastUpdate = $chatModel->last_update_user1;
            ChatModel::where(['id', '=', $request->chatId])->update([
                'last_update_user1' => date('Y-m-d H:i:s'),
            ]);
        } elseif ($chatModel && $chatModel->user2 == Auth::id()) {
            $lastUpdate = $chatModel->last_update_user2;
            ChatModel::where(['id', '=', $request->chatId])->update([
                'last_update_user2' => date('Y-m-d H:i:s'),
            ]);
        }

        if (!is_null($time)) {
            $response = DataBase::prepare("SELECT * FROM messages WHERE chat_id=" . $request->chatId . " AND time>'$time' AND status>'unread' AND (deleted_from IS NULL OR (deleted_from IS NOT NULL AND deleted_from!=" . Auth::id() . ")) ORDER BY id");
        } else {
            $response = DataBase::prepare("SELECT * FROM messages WHERE chat_id=" . $request->chatId . " AND status>'unread' AND (deleted_from IS NULL OR (deleted_from IS NOT NULL AND deleted_from!=" . Auth::id() . ")) ORDER BY id");
        }

        $myPhoto = Session::get('image');
        $user2Photo = DataBase::prepare("SELECT id,name,status,image,only_me,is_type FROM users WHERE id=" . $request->userId);

        if ($response != null) {
            $response = array_merge($user2Photo, ($response) ?? []);
            if ($response[count($response) - 1]->to_user == Auth::user()->id && (isset($request->click) || isset($request->reload))) {
                MessageModel::where(['chat_id', '=', $request->chatId])->update([
                    'status' => "read"
                ]);
            }
            $body = '';
            for ($i = 1; $i < count($response); $i++) {
                if (!is_null($response[$i]->body)) {
                    $msg = decryptMessage($response[$i]->body, utf8_decode($response[$i]->c2), utf8_decode($response[$i]->c1), utf8_decode($response[$i]->c3));

                    $msg = '<div class="msg_cotainer_send" style="white-space:pre;" dir="auto">' . htmlspecialchars($msg);
                } elseif (!is_null($response[$i]->files)) {
                    $file = $response[$i]->files;
                    $oldName = $response[$i]->oldName;
                    $arrOldName = explode('.', $oldName);
                    $arr = explode('.', $file);
                    $fileName = $arr[0];
                    $ext = end($arr);
                    $imageExt = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                    $videoExt = array('webm', 'mkv', 'mp4', 'avi');
                    $audioExt = array('mp3', 'm4a', 'oga', 'ogg', 'ogv', 'aac');
                    if (in_array($ext, $imageExt)) {
                        $msg = '
                        <div class="img_cotainer_send" dir="auto">
                                <img style="display:block;margin:auto;cursor:pointer" width="200" height="200" src="assets/chatUploads/' . $file . '" class="chat_img">
                            ';
                    } elseif (in_array($ext, $videoExt)) {
                        $msg = "<div class='msg_cotainer_send' style='white-space:pre;' dir='auto'><video width='300' src='assets/chatUploads/$file' controls></video>";
                    } elseif (in_array($ext, $audioExt)) {
                        $msg = '<div class="msg_cotainer_send" style="white-space:pre;" dir="auto">' . "<audio controls src='assets/chatUploads/$file'></audio>";
                    } else {
                        $msg = '<div class="msg_cotainer_send" style="white-space:pre;" dir="auto">' . "<a href='/download/$fileName/$arrOldName[0]/$ext'>$oldName</a>";
                    }
                }

                if ($response[$i]->from_user ==  Auth::user()->id) {
                    $color = ($response[$i]->status == 'read') ? 'color:#20c997' : '';

                    $body .= '<div class="d-flex justify-content-end mb-4"><i class="delete_msg fas fa-trash" data-id="' . $response[$i]->id . '" data-status="' . $response[$i]->status . '" data-to="' . $response[$i]->to_user . '"></i>' . $msg . '<span class="msg_time_send" dir="auto">' . date('h:i a', strtotime($response[$i]->time)) . '<span style="' . $color . '" class="uk-margin-small-right" uk-icon="check"></span></span></div>';

                    if ($i == 1 || ($i > 1 && $response[$i - 1]->from_user != Auth::user()->id)) {
                        $body .= '<div class="img_cont_msg"><img src="assets/images/' . $myPhoto . '" class="rounded-circle user_img_msg"></div>';
                    }

                    $body .= '</div>';
                } else {
                    $body .= '<div class="d-flex justify-content-start mb-4">';

                    if ($i == 1 || ($i > 1 && $response[$i - 1]->from_user == Auth::user()->id)) {
                        $body .= '<div class="img_cont_msg"><img src="assets/images/' . $response[0]->image . '" class="rounded-circle user_img_msg"></div>';
                    }

                    $body .= str_replace('msg_cotainer_send', 'msg_cotainer', $msg)  . '<span class="msg_time" dir="auto">' . date('h:i a', strtotime($response[$i]->time)) . '</span></div><i class="other_msg fas fa-trash delete_msg" data-id="' . $response[$i]->id . '" data-status="' . $response[$i]->status . '" data-to="' . $response[$i]->to_user . '"></i></div>';
                }
            }
        } else {
            $response = array_merge($user2Photo, []);
            $body = null;
        }

        $status = '';
        $lastSeen = '';
        if ($response[0]->status == 'Active now') {
            $status = '';
            $lastSeen = '';
        } else {
            $status = 'offline';
            $lastSeen = 'Last seen at ';
        }
        $check = UserModel::where(['id', '=', $response[0]->id])->get(['email']);
        if ($check) {
            $check = $check[0]->email;
        }

        if ($chatModel && $chatModel->block == 'yes' && ($chatModel->blocked_from1 == Auth::user()->id || $chatModel->blocked_from2 == Auth::user()->id)) {
            $block = 'unblock';
        } else {
            $block = 'block';
        }

        if ($check == "chatgo@gmail.com") {
            $href = '';
        } else {
            $href = 'href="/profile/' . $response[0]->id . '"';
        }

        if ($chatModel) {
            $block_status = $chatModel->block;
        } else {
            $block_status = '';
        }

        if ($chatModel && $chatModel->block != 'yes' && !is_null($response[0]->is_type) && $response[0]->is_type == $request->chatId) {
            $body .= '<div class="d-flex justify-content-start mb-4"><div class="img_cont_msg"><img src="assets/images/' . $response[0]->image . '" class="rounded-circle user_img_msg"></div><div class="msg_cotainer" style="white-space:pre" dir="auto">typing...<span class="msg_time" style="width:50px" dir="auto"></span></div></div>';
        }

        if ($chatModel && $chatModel->block == 'yes') {
            if ($body == null) {
                $body = '';
            }
            $body .= "<p style='text-align:center;color:#343a40;font-size:23px'>You Can't Sent Or Revieve Messages From This User</p>";
            $seen = '';
            $status = 'offline';
            $listAction = '';
            $href = '';
            $image = 'Blank-Avatar.png';
        } else if ($response[0]->only_me == 'yes') {
            $seen = $lastSeen . $response[0]->status;
            $image = $response[0]->image;
            $href = '';
            $listAction = '<li><i class="fas fa-plus"></i> Add to group</li>';
        } else {
            $seen = $lastSeen . $response[0]->status;
            $image = $response[0]->image;
            $listAction = '<li><i class="fas fa-user-circle"></i><a class="profile_link profile_link_button" href="/profile/' . $response[0]->id . '"> View profile</a></li>
            <li><i class="fas fa-plus"></i> Add to group</li>';
        }

        $head_change = '
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img src="/assets/images/' . $image . '" class="rounded-circle user_img">
                        <span class="online_icon ' . $status . '"></span>
                    </div>
                    <a class="profile_link profile_link_button" ' . $href . '>
                        <div class="user_info">
                            <span>' . htmlspecialchars($response[0]->name) . '</span>
                            <p>' . $seen . '</p>
                        </div>
                    </a>
                </div>
            ';
        $head_constant = '
                <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                <div class="action_menu">
                    <ul>
                        ' . $listAction . '
                        <li><i class="fas fa-trash"></i><a class="profile_link delete_link" href="/delete">Delete Chat</a></li>
                        <li><i class="fas fa-ban"></i><a class="profile_link block_link" href="/block/' . $response[0]->id . '">' . $block . '</a></li>
                    </ul>
                </div>';
        if ($check == 'chatgo@gmail.com') {
            $head_constant = '';
        }
        $response = [
            'body' => $body,
            'head_change' => $head_change,
            'head_constant' => $head_constant,
            'chat_id' => $request->chatId,
            'user_id' => $request->userId,
            'block_status' => $block_status,
            'only_me' => $response[0]->only_me
        ];

        echo json_encode($response);
    }
}
