$("#remove-image").click(function() {
    $.ajax({
        type: "POST",
        url: "/remove-image",
        data: {
            image: $("#profile-image").attr("src")
        },
        success: function(data) {
            $("#profile-image").attr("src", '/assets/images/' + data);
        }
    })
})

$("#file").change(function(e) {
    e.preventDefault();
    $("#form-image").submit();
})

$("#form-image").submit(function(e) {
    e.preventDefault();
    var form_data = new FormData(this);
    $.ajax({
        type: "POST",
        url: "/change-image",
        dataType: "JSON",
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.response == 'error') {
                $("#image-error-msg").css("display", "block");
                $("#image-error-msg").text(data.msg);
            } else {
                $("#file").val('');
                $("#image-error-msg").css("display", "none");
                $("#profile-image").attr("src", '/assets/images/' + data.image);
            }
        }
    })
})

$("#onlyMe").click(function() {
    var value = $("#onlyMe-value").attr("uk-icon");
    if (value == 'unlock') {
        value = 'yes';
    } else {
        value = 'no';
    }
    $.ajax({
        type: "POST",
        url: "/change-only-me",
        data: {
            only_me: value
        },
        success: function(data) {
            $("#onlyMe-value").attr("uk-icon", data)
        }
    })
})

$("#lastSeen_onlyMe").click(function() {
    var value = $("#lastSeen_onlyMe-value").attr("uk-icon");
    if (value == 'unlock') {
        value = 'yes';
    } else {
        value = 'no';
    }
    $.ajax({
        type: "POST",
        url: "/change-lastSeen_onlyMe",
        data: {
            lastSeen_onlyMe: value
        },
        success: function(data) {
            $("#lastSeen_onlyMe-value").attr("uk-icon", data)
        }
    })
})

$("#form-pio").on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/change-pio",
        data: {
            pio: $('#pio-text').val()
        },
        success: function(data) {
            $("#pio-p").html("Pio : " + data);
            $('#pio-text').val('');
        }
    })
})

$("#form-name").on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/change-name",
        dataType: "JSON",
        data: {
            name: $('#name').val()
        },
        success: function(data) {
            if (data.response == 'error') {
                $("#name-error-msg").css("display", "block");
                $("#name-error-msg").text(data.msg);
            } else {
                $("#name-error-msg").css("display", "none");
                $("#name-p").html("Name : " + data.name);
                $('#name').val('');
            }
        }
    })
})

$("#form-email").on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/change-email",
        dataType: "JSON",
        data: {
            email: $('#email').val()
        },
        success: function(data) {
            if (data.response == 'error') {
                $("#email-error-msg").css("display", "block");
                $("#email-error-msg").text(data.msg);
            } else {
                $("#email-error-msg").css("display", "none");
                $("#email-p").html("Email : " + data.email);
                $('#email').val('');
            }
        }
    })
})

$("#form-phone").on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/change-phone",
        dataType: "JSON",
        data: {
            phone: $('#phone').val()
        },
        success: function(data) {
            if (data.response == 'error') {
                $("#phone-error-msg").css("display", "block");
                $("#phone-error-msg").text(data.msg);
            } else {
                $("#phone-error-msg").css("display", "none");
                $("#phone-p").html("Phone : " + data.phone);
                $('#phone').val('');
            }
        }
    })
})