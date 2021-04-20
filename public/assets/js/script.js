var myId = $('#myId').val();

// display image from chat
$(document).on('click', '.chat_img', function() {
    $("#chatImg").css("display", 'block');
    $("#chatImg").attr("src", $(this).attr("src"));
    $("#displayImages").show(500);
})

// display video from chat
$(document).on('click', '.chat_video', function() {
    $("#chatVideo").css("display", 'block');
    $("#chatVideo").attr("src", "assets/chatUploads/" + $(this).attr("data-src"));
    $("#displayImages").show(500);
})

// display audio from chat
$(document).on('click', '.chat_audio', function() {
    $("#chatAudio").css("display", 'block');
    $("#chatAudio").attr("src", "assets/chatUploads/" + $(this).attr("data-src"));
    $("#displayImages").show(500);
})

// close lightbox
$("#close").click(function() {
    $('#chatVideo').trigger('pause');
    $('#chatAudio').trigger('pause');
    $("#displayImages").hide(500);
    $("#chatImg").css("display", 'none');
    $("#chatVideo").css("display", 'none');
    $("#chatAudio").css("display", 'none');
})

// upload files
$("#file").change(function() {
    $("#send_msg").submit();
});

// create emojis box ----------------------------------------
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
    // @end emojis -----------------------------------------------

// show menu for delete message
$(document).on('click', '.delete_msg', function(e) {
    var msg_id = $(this).attr('data-id');
    var msg_to = $(this).attr('data-to');
    var msg_status = $(this).attr('data-status');
    var menu = document.getElementById("menu");
    menu.style.display = 'block';
    menu.style.left = e.pageX + "px";
    menu.style.top = e.pageY + "px";

    if (msg_status == 'read' || msg_to == myId) {
        $("#everyone_button").hide();
    } else {
        $("#everyone_button").show();
    }
    $('#menu').attr('data-id', msg_id);
});

// delete message
$('#menu').on('click', function(e) {
    var choose = e.target.innerHTML;
    if (choose == 'Delete For Me') {
        $.ajax({
            type: "POST",
            url: "/delete_msg_for_me",
            data: {
                msg_id: $(this).attr('data-id')
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
})

// close menu deleting options
$('body').on('click', function() {
    $('#menu').hide();
})

// run on close browser
$(window).on('unload', function() {
    $.ajax({
        url: "/closeBrowser",
        type: "GET"
    });
})

// delete all chat
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

// load all chats 
function allChat() {
    $.ajax({
        type: "POST",
        url: "/allChat",
        dataType: "JSON",
        success: function(result) {
            if (result == "no result") {
                // no chats available
                $(".allChat").html("<p style='text-align: center;font-size:23px'>No Chat Avilable</p>");
            } else {
                var data = '';
                var status;
                var active;
                var display;
                for (let index = 0; index < result.length; index++) {
                    if (result[index].status == "typing...") {
                        status = '';
                        active = 'typing...'
                    } else if (result[index].status == "recording...") {
                        status = '';
                        active = 'recording...'
                    } else if (result[index].status == "Active now") {
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

                    if (result[index].lastSeen_onlyMe == 'yes') {
                        active = '';
                    }

                    if (result[index].msgNum > 0 && result[index].to_user == myId) {
                        display = 'block';
                    } else {
                        display = 'none';
                    }

                    data += '<li data-userId="' + result[index].id + '" data-chatId="' + result[index].chat_id + '" class="chat_head">';
                    data += '<div class="d-flex bd-highlight">';
                    data += '<div class="img_cont">';
                    data += '<img src="/assets/images/' + image + '" class="rounded-circle user_img">';
                    data += '<span class="online_icon ' + status + '"></span></div>';
                    data += '<div class="user_info">';
                    data += '<span>' + result[index].name + '</span>';
                    data += active;
                    data += '</div><span style="display:' + display + '" class="uk-badge">' + result[index].msgNum + '</span></div></li>';
                }

                $(".allChat").html(data);
                var user_id = $('#user_id').val();
                $("li[data-userId='" + user_id + "']").addClass("active");
            }
        }
    })
}
allChat();

// search about user by email or phone
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

                    data += '<li class="chat_head" data-userId="' + result[index].id + '" data-chatId="' + result[index].chat_id + '">';
                    data += '<div class="d-flex bd-highlight">';
                    data += '<div class="img_cont">';
                    data += '<img src="/assets/images/' + image + '" class="rounded-circle user_img">';
                    data += '<span class="online_icon ' + status + '"></span>';
                    data += '</div>';
                    data += '<div class="user_info">';
                    data += '<span>' + result[index].name + '</span>';
                    data += active;
                    data += '</div></div></li>';
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

// submit search form
$("#search-form").submit(function(e) {
    e.preventDefault();
    search();
})

// submit search form with every keyup
$("#text_search").keyup(function() {
    search();
});

// trigger click from icon to file input to choose file
$(function() {
    $("#span_file").click(function() {
        $("#file").trigger("click");
    });
});

// send message text or files
$("#send_msg").submit(function(e) {
    e.preventDefault();
    $("#emojiList").css('display', 'none');
    var form_data = new FormData(this);

    // send files
    if ($("#file").val() != '') {
        $("#file").val('');
        $(".uk-progress").show();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".uk-progress").val(percentComplete);
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            url: "/send_file",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != "error") {
                    $(".uk-progress").hide();
                    $("#chat_id").val(response);
                    $("#file").val('');
                    reloadChat(true);
                }
            }
        })
    } else {
        // send text message
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
                    reloadChat(true);
                }
            }
        })
    }
})

// load chat and open
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

// reload chat to update messages, user information and action menu 
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

// run reloadchat function and allchat function every 1 sec
function reload() {
    setTimeout(function() {
        reloadChat();
        allChat();
        reload();
    }, 1000);
}
reload();

// block user
$(document).on("click", ".block_link", function(e) {
    e.preventDefault();

    var unblock = ($(this).text() == 'unblock') ? 'true' : 'false';

    $.ajax({
        type: "GET",
        url: "/block/" + $("#user_id").val(),
        data: {
            unblock: unblock
        },
        success: function(data) {
            $("#chat_id").val(data);
            reloadChat(true, true);
            search();
        }
    })
})

// open user profile
$(document).on('click', '.profile_link_button', function(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/profile/" + $("#user_id").val(),
        dataType: "JSON",
        success: function(data) {
            if (data != "refused") {
                $("#name-text").text(data.name);
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
})

// close user profile session
$("#close-user-profile").click(function() {
    $("#chat-head-search").show(1000);
    $("#user-profile").hide(500);
})

// show typing status
$("#msg").on("keyup", function() {
    if ($(this).val().trim() != "") {
        $.ajax({
            type: "POST",
            url: "/type-status/" + $("#chat_id").val()
        })
    } else {
        $.ajax({
            type: "POST",
            url: "/type-status"
        })
    }
})

$("#msg").on("focus", function() {
    if ($(this).val().trim() != "") {
        $.ajax({
            type: "POST",
            url: "/type-status/" + $("#chat_id").val()
        })
    }
})

$("#msg").on("focusout", function() {
    $.ajax({
        type: "POST",
        url: "/type-status"
    })
})