<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= session('title') ?></title>
    <!-- Fav Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
    <link rel="manifest" href="/assets/images/site.webmanifest">
    <link rel="mask-icon" href="/assets/images/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="/assets/images/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="<?= assets('css/uikit.min.css') ?>" />
    <!-- Google font -->
    <!-- link your font here -->
    <!-- My CSS  -->
    <link rel="stylesheet" href="<?= assets('css/preloader.css') ?>">
    <?= session('heads'); ?>
</head>

<body>

    <div class="preload">
        <div class="loader">Loading...</div>
    </div>

    <main>
        <?= session('content') ?>
    </main>

    <!-- JQuery  -->
    <script src="<?= assets('js/jquery-3.5.1.min.js') ?>"></script>
    <!-- UIkit JS -->
    <script src="<?= assets('js/uikit.min.js') ?>"></script>
    <script src="<?= assets('js/uikit-icons.min.js') ?>"></script>
    <!-- My script -->
    <script src="<?= assets("js/main.js") ?>"></script>
    <!-- preloader function -->
    <script>
        $(window).on("load", function() {
            $(".preload").fadeOut("slow");
        });
    </script>
    <?= session('scripts'); ?>
</body>

</html>