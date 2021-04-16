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
        <a id="logout" href="/my-profile"><button class="btn btn-primary">
                <img src="<?= assets("images/") . Auth::user()->image ?>" class="rounded-circle my_img_msg">
                <?= htmlspecialchars(Auth::user()->name) ?>
            </button></a>
        <a id="logout" href="/logout"><button class="btn btn-danger">Logout</button></a>
    </div>
    <div id="displayImages" class="uk-box-shadow-large">
        <button id="close" type="button" uk-close class="uk-close-large"></button>
        <div class="uk-position-relative mt-3" uk-slideshow="ratio: 7:3;animation: fade">

            <ul class="uk-slideshow-items" id="list-images">

            </ul>

            <div class="uk-position-bottom-center uk-position-small">
                <ul class="uk-thumbnav" id="controllers">
                </ul>
            </div>

        </div>
        <button id="send_test" type="button" class="btn w-25 ml-auto mr-auto mt-2 d-block btn-success text-uppercase font-weight-bold">send</button>
    </div>
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div id="chat-head-search" style="overflow-y: auto;">
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
                <div class="card-footer" style="display:none">
                    <form id="send_msg" method="POST" enctype="multipart/form-data" action="/send_msg">
                        <div class="input-group">
                            <input type="text" name="chat_id" id="chat_id" hidden>
                            <input type="text" name="user_id" id="user_id" hidden>
                            <input id="file" name="files[]" type="file" multiple hidden accept="image/*" />
                            <div class="input-group-append">
                                <span id="span_file" class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                <span id="span_emoji" class="input-group-text">&#128512</span>
                            </div>
                            <textarea style="resize: none" dir="auto" id="msg" name="msg" class="form-control type_msg" placeholder="Type your message..."></textarea>
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
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
    </ul>
</div>

<?php endSession("content") ?>

<?php startSession('scripts') ?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>


<script>
    for (let i = 129296; i < 129326; i++) {
        $(".emojis").prepend("<li class='emojiIcon'>&#" + i + "</li>");
    }

    for (let i = 128588; i >= 128512; i--) {
        $(".emojis").prepend("<li class='emojiIcon'>&#" + i + "</li>");
    }

    for (let i = 128068; i < 128080; i++) {
        $(".emojis").append("<li class='emojiIcon'>&#" + i + "</li>");
    }

    for (let i = 128147; i < 128159; i++) {
        $(".emojis").append("<li class='emojiIcon'>&#" + i + "</li>");
    }

    $(document).on('click', '.emojiIcon', function() {
        var input = $("#msg").val();
        $("#msg").val(input + $(this).text().trim());
    })

    $(document).on("click", '#span_emoji', function(e) {
        $("#emojiList").toggle();
    })

    $("#msg").on("focus", function() {
        var menu = document.getElementById("emojiList");
        menu.style.display = 'none'
    })

    var execute = 0;
    $(document).on('click', '.delete_msg', function(e) {
        var msg_id = $(this).attr('data-id');
        var msg_to = $(this).attr('data-to');
        var msg_status = $(this).attr('data-status');
        var menu = document.getElementById("menu")
        menu.style.display = 'block';
        menu.style.left = e.pageX + "px";
        menu.style.top = e.pageY + "px";

        if (msg_status == 'read' || msg_to == "<?= Auth::id() ?>") {
            $("#everyone_button").hide();
        } else {
            $("#everyone_button").show();
        }

        $('#menu').attr('data-id', msg_id);
        $('#menu').on('click', function(e) {
            if (execute == 0) {
                execute = 1;
                var choose = e.target.innerHTML;
                if (choose == 'Delete For Me') {
                    $.ajax({
                        type: "POST",
                        url: "/delete_msg_for_me",
                        data: {
                            msg_id: $(this).attr('data-id')
                        },
                        success: function(response) {

                        }
                    })
                } else if (choose == 'Delete For Everyone') {
                    $.ajax({
                        type: "POST",
                        url: "/delete_msg_for_everyone",
                        data: {
                            msg_id: $(this).attr('data-id')
                        }
                    })
                }
            }
        })
    });

    $('body').on('click', function() {
        var menu = document.getElementById("menu")
        menu.style.display = 'none';
        execute = 0;
    })

    $("#file").change(function(e) {
        e.preventDefault();
        var form_data = new FormData(document.getElementById("send_msg"));
        $.ajax({
            type: "POST",
            url: "/display",
            dataType: "JSON",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $("#list-images").html(response.images);
                $("#controllers").html(response.controllers);
                $("#displayImages").show();
            }
        })
    })

    document.addEventListener("keydown", function(event) {
        if (event.which == 27) {
            $("#displayImages").hide(500);
        }
    })

    $("#close").click(function() {
        $("#displayImages").hide(500);
    })

    $(window).on('unload', function() {
        $.ajax({
            url: "/closeBrowser",
            type: "GET"
        });
    })

    $(document).on('click', '.delete_link', function(e) {
        e.preventDefault();
        if (confirm("Are you sure you want to delete this chat?")) {
            $.ajax({
                type: "POST",
                url: "/delete_chat",
                data: {
                    chat_id: $("#chat_id").val(),
                }
            })
        }
    })

    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
        });
    });

    function allChat() {
        $.ajax({
            type: "POST",
            url: "/allChat",
            dataType: "JSON",
            success: function(result) {
                if (result == "no result") {
                    $(".allChat").html("<p style='text-align: center;font-size:23px'>No Chat Avilable</p>");
                } else {
                    var data = '';
                    var status;
                    var active;
                    var display;
                    for (let index = 0; index < result.length; index++) {
                        if (result[index].status == "Active now") {
                            status = '';
                            active = 'online'
                        } else {
                            status = 'offline';
                            active = 'offline';
                        }
                        if (result[index].block == 'yes') {
                            status = 'offline';
                            active = '';
                            var image = 'Blank-Avatar.png';
                        } else {
                            active = '<p>' + result[index].name + ' is ' + active + '</p>';
                            var image = result[index].image;
                        }
                        if (result[index].msgNum > 0 && result[index].to_user == <?= Auth::user()->id ?>) {
                            display = 'block';
                        } else {
                            display = 'none';
                        }
                        data += '<li data-userId="' + result[index].id + '" data-chatId="' + result[index].chat_id + '" class="chat_head"><div class="d-flex bd-highlight"><div class="img_cont"><img src="/assets/images/' + image + '" class="rounded-circle user_img"><span class="online_icon ' + status + '"></span></div><div class="user_info"><span>' + result[index].name + '</span>' + active + '</div><span style="display:' + display + '" class="uk-badge">' + result[index].msgNum + '</span></div></li>';
                    }
                    $(".allChat").html(data);
                    var user_id = $('#user_id').val();
                    $("li[data-userId='" + user_id + "']").addClass("active");
                }
            }
        })
    }
    allChat();

    function search() {
        $.ajax({
            type: "POST",
            url: "/search",
            dataType: "JSON",
            data: {
                text_search: $("#text_search").val()
            },
            success: function(result) {
                if (result == "no result") {
                    $(".allChat").css('display', 'block');
                    $(".searchList").css("display", "none");
                    allChat();
                } else {
                    var data = '';
                    var status;
                    var active;
                    for (let index = 0; index < result.length; index++) {
                        if (result[index].status == "Active now") {
                            status = '';
                            active = 'online';
                        } else {
                            status = 'offline';
                            active = 'offline';
                        }
                        if (result[index].block == 'yes') {
                            status = 'offline';
                            active = '';
                            var image = 'Blank-Avatar.png';
                        } else {
                            active = '<p>' + result[index].name + ' is ' + active + '</p>';
                            var image = result[index].image;
                        }
                        data += '<li class="chat_head" data-userId="' + result[index].id + '" data-chatId="' + result[index].chat_id + '"><div class="d-flex bd-highlight"><div class="img_cont"><img src="/assets/images/' + image + '" class="rounded-circle user_img"><span class="online_icon ' + status + '"></span></div><div class="user_info"><span>' + result[index].name + '</span>' + active + '</div></div></li>';
                    }
                    $(".searchList").html(data);
                    $(".allChat").css('display', 'none');
                    $(".searchList").css("display", "block");
                    var user_id = $('#user_id').val();
                    $("li[data-userId='" + user_id + "']").addClass("active");
                }
            }
        })
    }

    $("#search-form").submit(function(e) {
        e.preventDefault();
        search();
    })

    $("#text_search").keyup(function() {
        search();
    });

    $(function() {
        $("#span_file").click(function() {
            $("#file").trigger("click");
        });
    });

    $("#send_msg").submit(function(e) {
        e.preventDefault();
        $("#emojiList").css('display', 'none');
        var form_data = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/send_msg",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != "error") {
                    $("#chat_id").val(response);
                    $("#msg").val('');
                    $("#file").val('');
                    reloadChat(true);
                    allChat();
                }
            }
        })
    })

    $(document).on("click", ".chat_head", function() {
        $(".card-footer").css("display", "block");
        $(".chat_head").removeClass("active");
        $(this).addClass("active");
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "/loadChat",
            data: {
                chatId: $(this).attr("data-chatId"),
                userId: $(this).attr("data-userId"),
                click: 'yes'
            },
            success: function(result) {
                $("#head_change").html(result.head_change);
                $("#head_constant").html(result.head_constant);
                if (result.body == null) {
                    $('.msg_card_body').html('');
                } else {
                    $('.msg_card_body').html(result.body);
                }
                $('#chat_id').val(result.chat_id);
                $('#user_id').val(result.user_id);
                $('#block').val(result.block_status);
                $('#only_me').val(result.only_me);
                $(".msg_card_body").scrollTop($('.msg_card_body').prop('scrollHeight'));
                $('#action_menu_btn').click(function() {
                    $('.action_menu').toggle();
                });
            }
        })
    })

    function reloadChat(scroll = null, listAction = null) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "/loadChat",
            data: {
                chatId: $("#chat_id").val(),
                userId: $("#user_id").val(),
                reload: 'yes'
            },
            success: function(result) {
                var scrollpos = $(".msg_card_body").scrollTop();
                var scrollpos = parseInt(scrollpos) + parseInt($(".msg_card_body").height());
                var scrollHeight = $('.msg_card_body').prop('scrollHeight');
                $("#head_change").html(result.head_change);
                if (listAction != null || $("#block").val() != result.block_status || $("#only_me").val() != result.only_me) {
                    $("#block").val(result.block_status);
                    $("#only_me").val(result.only_me);
                    $("#head_constant").html(result.head_constant);
                    $('#action_menu_btn').click(function() {
                        $('.action_menu').toggle();
                    });
                }
                if (result.body == null) {
                    $('.msg_card_body').html('');
                } else {
                    $('.msg_card_body').html(result.body);
                }

                if (!(scrollpos < (scrollHeight - 100)) || scroll != null) {
                    $(".msg_card_body").scrollTop($('.msg_card_body').prop('scrollHeight'));
                }
            }
        })
    }

    setInterval(function() {
        reloadChat();
        allChat();
    }, 1000);

    $(document).on("click", ".block_link", function(e) {
        e.preventDefault();
        if ($(this).text() == 'unblock') {
            var unblock = 'true';
        } else {
            var unblock = 'false';
        }
        $.ajax({
            type: "GET",
            url: "/block/" + $("#user_id").val(),
            data: {
                unblock: unblock
            },
            success: function(data) {
                $("#chat_id").val(data);
                reloadChat(true, true);
                allChat();
                search();
            }
        })
    })

    $(document).on('click', '.profile_link', function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/profile/" + $("#user_id").val(),
            dataType: "JSON",
            success: function(data) {
                if (data != "refused") {
                    $("#name-text").text(data.name);
                    console.log(data);
                    if (data.about == "") {
                        $("#pio-head").hide();
                    } else {
                        $("#pio-head").show();
                        $("#pio-text").text(data.about);
                    }
                    $("#email-text").text(data.email);
                    $("#phone-text").text(data.phone);
                    $("#image-href").attr("href", "/assets/images/" + data.image);
                    $("#image-src").attr("src", "/assets/images/" + data.image);
                    $("#chat-head-search").hide(500);
                    $("#user-profile").show(1000);
                }
            }
        })

        $("#close-user-profile").click(function() {
            $("#chat-head-search").show(1000);
            $("#user-profile").hide(500);
        })
    })
</script>

<?php endSession("scripts") ?>