<?php extend('layouts/main') ?>
<?php session('title', 'My Profile') ?>
<?php startSession('heads') ?>
<!-- material icon css -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?= assets('css/myprofile.style.css') ?>">
<?php endSession('heads') ?>
<?php startSession('content') ?>

<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <img id="profile-image" src="<?= assets("images/$image") ?>" alt="" />
                <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <form id="form-image" enctype="multipart/form">
                        <input type="file" name="file" id="file" />
                    </form>
                </div>
                <div class="remove btn btn-lg btn-primary">
                    <a id="remove-image" href="javascript:;" onclick="confirm('Do You Want to Remove Your Image')">Remove Photo</a>
                </div>
            </div>
            <p id="image-error-msg" style="color:red;display:none"></p>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    Edit Your Profile Information
                </h5>
                <p id="info">Who Can See Your Profile?<br>when only me is lock no one can see your profile information.<br>when only me is unlock everyone can see your profile information.<button type="button" id="onlyMe">only me<span id="onlyMe-value" uk-icon="<?= $only_me ?>"></span></button></p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <a href="/" class="profile-edit-btn" name="btnAddMore">Home Page</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="profile-work">
                <p>About Me</p>
                <p id="name-p">Name : <?= htmlspecialchars($name) ?></p>
                <p id="pio-p">Pio : <?= htmlspecialchars($about) ?></p>
                <p id="email-p">Email : <?= htmlspecialchars($email) ?></p>
                <p id="phone-p">Phone : <?= htmlspecialchars($phone) ?></p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <form method="post" action="/change-pass" class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <p style="color:red;"><?= flash('error') ?></p>
                            <label class="uk-form-label" for="form-horizontal-text">Current Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" name="current_pass" type="password">
                                <p style="color:red;"><?= errors('current_pass') ?></p>
                            </div>
                            <label class="uk-form-label" for="form-horizontal-text">New Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" name="new_pass" id="new_pass" type="password">
                                <p style="color:red"><?= errors('new_pass') ?></p>
                            </div>
                            <label class="uk-form-label" for="form-horizontal-text">Repeat New Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" name="repeat_password" id="repeat_password" type="password">
                            </div>
                            <div class="uk-form-controls">
                                <button type="submit" class="sub-but uk-input uk-form-width-large">Change Password</button>
                            </div>
                        </div>
                    </form>

                    <form id="form-name" class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" id="name" type="text">
                                <p id="name-error-msg" style="color:red;display:none"></p>
                            </div>
                            <div class="uk-form-controls">
                                <button type="submit" class="sub-but uk-input uk-form-width-large">Change Name</button>
                            </div>
                        </div>
                    </form>

                    <form id="form-email" class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" id="email" type="email">
                                <p id="email-error-msg" style="color:red;display:none"></p>
                            </div>
                            <div class="uk-form-controls">
                                <button type="submit" class="sub-but uk-input uk-form-width-large">Change Email</button>
                            </div>
                        </div>
                    </form>

                    <form id="form-phone" class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Phone</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" id="phone" type="text">
                                <p id="phone-error-msg" style="color:red;display:none"></p>
                            </div>
                            <div class="uk-form-controls">
                                <button type="submit" class="sub-but uk-input uk-form-width-large">Change Phone</button>
                            </div>
                        </div>
                    </form>

                    <form id="form-pio" class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Pio</label>
                            <div class="uk-margin">
                                <textarea id="pio-text" class="uk-textarea" rows="3" placeholder="Textarea" dir="auto" style="resize:none"></textarea>
                            </div>
                            <div class="uk-form-controls">
                                <button type="submit" class="sub-but uk-input uk-form-width-large">Change Pio</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php endSession('content') ?>
<?php startSession('scripts') ?>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script>
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
</script>
<?php endSession('scripts') ?>