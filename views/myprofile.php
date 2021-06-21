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
                    <a id="remove-image" href="javascript:;">Remove Photo</a>
                </div>
            </div>
            <p id="image-error-msg" style="color:red;display:none"></p>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    Edit Your Profile Information
                </h5>
                <p>Who Can See Your Profile?<br>when only me is lock no one can see your profile information.<br>when only me is unlock everyone can see your profile information.<button type="button" id="onlyMe">only me<span id="onlyMe-value" uk-icon="<?= $only_me ?>"></span></button></p>
                <p><button type="button" id="lastSeen_onlyMe">Last Seen only me<span id="lastSeen_onlyMe-value" uk-icon="<?= $lastSeen_onlyMe ?>"></span></button></p>
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
<script src="<?= assets('js/changeProfile.js') ?>"></script>

<?php endSession('scripts') ?>