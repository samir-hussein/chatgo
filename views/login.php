<?php extend('layouts/main') ?>
<?php session('title', 'Login') ?>
<?php startSession('heads') ?>
<!-- material icon css -->
<link rel="stylesheet" href="<?= assets("fonts/material-icon/css/material-design-iconic-font.min.css") ?>">
<link rel="stylesheet" href="<?= assets('css/style.css') ?>">
<?php endSession('heads') ?>
<?php startSession('content') ?>

<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <p style="color:green;font-size:25px;text-align:center;"><?= flash('success') ?></p>
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="<?= assets("images/signin-image.jpg") ?>" alt="sing up image"></figure>
                    <a href="/register" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign in</h2>
                    <p style="color:red;"><?= $errors ?? null ?></p>
                    <form action="/login" method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" id="your_name" placeholder="Your Email" value="<?= old("email") ?>" />
                        </div>
                        <p class="msg"><?= errors('email') ?></p>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="your_pass" placeholder="Password" />
                        </div>
                        <p class="msg"><?= errors('pass') ?></p>
                        <div class="form-group">
                            <input type="checkbox" name="remember_me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<?php endSession("content") ?>

<?php startSession("scripts") ?>
<script src="<?= assets('js/script.js') ?>"></script>
<?php endSession("scripts") ?>