<?php extend('layouts/main') ?>
<?php session('title', 'Register') ?>
<?php startSession('heads') ?>
<!-- material icon css -->
<link rel="stylesheet" href="<?= assets("fonts/material-icon/css/material-design-iconic-font.min.css") ?>">
<link rel="stylesheet" href="<?= assets('css/style.css') ?>">
<?php endSession('heads') ?>
<?php startSession('content') ?>

<div class="main">
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <p class="msg"><?= flash('error') ?></p>
                    <form action="/create-user" method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" value="<?= old('name') ?>" />
                        </div>
                        <p class="msg"><?= errors('name') ?></p>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" value="<?= old('email') ?>" />
                        </div>
                        <p class="msg"><?= errors('email') ?></p>
                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                            <input type="text" name="phone" id="phone" placeholder="Your Phone" value="<?= old('phone') ?>" />
                        </div>
                        <p class="msg"><?= errors('phone') ?></p>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" />
                        </div>
                        <p class="msg"><?= errors('pass') ?></p>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="<?= assets("images/signup-image.jpg") ?>" alt="sing up image"></figure>
                    <a href="/login" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php endSession("content") ?>

<?php startSession("scripts") ?>
<script src="<?= assets('js/script.js') ?>"></script>
<?php endSession("scripts") ?>