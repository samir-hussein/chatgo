<?php

use App\Auth;
?>
<?php extend('layouts/main') ?>
<?php session('title', 'Chat go') ?>
<?php startSession('heads') ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" href="<?= assets('css/welcome.style.css') ?>">
<?php endSession("heads") ?>

<?php startSession('content') ?>

<div class="container-fluid h-100">

    <div id="logoutDiv" class="d-flex justify-content-between">
        <!-- my profile button -->
        <a id="logout" href="/my-profile"><button class="btn btn-primary">
                <img src="<?= assets("images/") . Auth::user()->image ?>" class="rounded-circle my_img_msg">
                <?= htmlspecialchars(Auth::user()->name) ?>
            </button></a>
        <!-- logout button -->
        <a id="logout" href="/logout"><button class="btn btn-danger">Logout</button></a>
    </div>

    <!-- lightbox to display images, videos and recordes from chat -->
    <div id="displayImages" class="uk-box-shadow-large">
        <!-- close lightbox button -->
        <button id="close" type="button" uk-close class="uk-close-large"></button>
        <!-- to display images -->
        <img id="chatImg" style="display:none;margin:auto;width:90%;height:100%">
        <!-- to display videos -->
        <video id="chatVideo" autoplay controls style="display:none;margin:auto;width:90%;max-height:100%"></video>
        <!-- to display audios -->
        <audio id="chatAudio" controls autoplay style="display:none;margin:auto"></audio>
    </div>

    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div id="chat-head-search" style="overflow-y: auto;">
                    <!-- search form -->
                    <form method="post" action="" id="search-form">
                        <div class="card-header">
                            <div class="input-group">
                                <input type="text" placeholder="Enter email or phone to Search..." name="text_search" id="text_search" class="form-control search">
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text search_btn"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <input type="hidden" id="block" />
                    <input type="hidden" id="only_me" />
                    <div class="card-body contacts_body">
                        <ui class="contacts allChat">

                        </ui>
                        <ui class="contacts searchList" style="display:none">

                        </ui>
                    </div>
                </div>
                <div style="overflow-y: auto;display:none;color:#fff;" id="user-profile">
                    <span uk-icon="icon: arrow-left; ratio: 3" style="cursor:pointer" class="uk-position-top-left" id="close-user-profile"></span>
                    <div uk-lightbox class="uk-text-center">
                        <a style="border:none;padding:0;" class="uk-button uk-button-default" id="image-href">
                            <img id="image-src" style="display:block;margin:auto;margin-top:10%" class="uk-border-circle" width="200" height="200" alt="Border circle">
                        </a>
                    </div>
                    <h3 class="uk-text-center uk-text-capitalize" id="name-text">name</h3>
                    <div class="uk-text-large uk-text-center" style="padding:2%">
                        <h4 class="uk-heading-line uk-text-center uk-text-bold" id="pio-head"><span>Pio</span></h4>
                        <p class="uk-display-inline" id="pio-text"></p>
                        <br>
                        <br>
                        <h4 class="uk-heading-line uk-text-center uk-text-bold"><span>Email</span></h4>
                        <p class="uk-display-inline" id="email-text"></p>
                        <br>
                        <br>
                        <h4 class="uk-heading-line uk-text-center uk-text-bold"><span>Phone</span></h4>
                        <p class="uk-display-inline" id="phone-text"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div id="head_change">

                    </div>
                    <div id="head_constant">

                    </div>
                </div>
                <div class="card-body msg_card_body" id="msg_card_body">
                    <img style="display:block;margin:auto;margin-top:10%" class="uk-border-circle" src="<?= assets("images/android-chrome-192x192.png") ?>" width="170" height="170" alt="Border circle">
                    <p style='text-align:center;font-size:25px'>Welcome In Chat Go <br> Choose Chat To Display</p>
                </div>
                <progress id="js-progressbar" class="uk-progress" value="0" max="100" style="display:none"></progress>
                <div id="counter" style="display:none;margin:auto"><span id="min">00</span>:<span id="sec">00</span></div>
                <div class="card-footer" style="display:none">
                    <form id="send_msg" method="POST" enctype="multipart/form-data" action="/send_msg">
                        <div class="input-group">
                            <input type="text" name="chat_id" id="chat_id" hidden>
                            <input type="text" name="user_id" id="user_id" hidden>
                            <input id="file" name="files[]" type="file" multiple hidden />
                            <div class="input-group-append">
                                <span id="span_file" class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                <span id="span_emoji" class="input-group-text">&#128512</span>
                            </div>
                            <textarea style="resize: none" dir="auto" id="msg" name="msg" class="form-control type_msg" placeholder="Type your message..."></textarea>
                            <div class="input-group-append" id="buttons">
                                <button type="submit" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                                <button id="start_record" type="button" class="input-group-text" style="cursor:pointer"><i class="fas fa-microphone"></i></button>
                                <button id="cancel_record" type="button" class="input-group-text" style="cursor:pointer;display:none"><i class="fas fa-times"></i></button>
                                <button id="send_record" type="button" class="input-group-text" style="cursor:pointer;display:none"><i class="fas fa-share"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="menu">
    <ul>
        <li>Delete For Me</li>
        <li id="everyone_button">Delete For Everyone</li>
    </ul>
</div>

<div uk-filter="target: .js-filter" id="emojiList">
    <ul class="js-filter emojis">
        <li class='emojiIcon'>&#128170</li>
        <li class='emojiIcon'>&#9994</li>
        <li class='emojiIcon'>&#9995</li>
        <li class='emojiIcon'>&#129330</li>
        <li class='emojiIcon'>&#9996</li>
        <li class='emojiIcon'>&#128169</li>
        <li class='emojiIcon'>&#127925</li>
        <li class='emojiIcon'>&#127926</li>
        <li class='emojiIcon'>&#128121</li>
        <li class='emojiIcon'>&#128123</li>
        <li class='emojiIcon'>&#128131</li>
        <li class='emojiIcon'>&#128133</li>
        <li class='emojiIcon'>&#127801</li>
        <li class='emojiIcon'>&#128139</li>
        <li class='emojiIcon'>&#128293</li>
        <li class='emojiIcon'>&#128222</li>
        <li class='emojiIcon'>&#128286</li>
        <li class='emojiIcon'>&#129335</li>
        <li class='emojiIcon'>&#128175</li>
    </ul>
</div>

<input type="text" id="myId" value="<?= Auth::id() ?>" hidden>

<?php endSession("content") ?>

<?php startSession('scripts') ?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?= assets('js/record.js') ?>"></script>
<script src="<?= assets('js/script.js') ?>"></script>

<?php endSession("scripts") ?>