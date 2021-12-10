<html>
    <head>
        <?php $this->renderSection("title") ?>
        <link rel="stylesheet" type="text/css" href=<?= base_url('css/layout7.css') ?>>
        <link rel="icon" href="<?= base_url('icon.png') ?>">
    </head>

    <body>
        <div class="header">
            <div class="nav-bar">
                <div>
                    <a class="logo" href=<?= base_url("") ?>>YYDS</a>
                </div>
                <div class="nav">
                    <a class="nav-item" href=<?= base_url("") ?>>Home</a>
                    <a class="nav-item" href=<?= base_url("about") ?>>About</a>
                </div>
                <div class="nav nav-right">
                    <?php if(session()->get("currentUser") !== NULL): ?>
                        <a class="nav-item profile-btn" href=<?= base_url("profile/" . $_SESSION["currentUser"]["USERNAME"]) ?>><?= $_SESSION["currentUser"]["USERNAME"] ?></a>
                        <a class="nav-item" href=<?= base_url("post/new") ?>>New Post</a>
                        <a class="nav-item" href=<?= base_url("logout") ?>>Logout</a>
                    <?php else: ?>
                        <a class="nav-item" href=<?= base_url("login") ?>>Login</a>
                        <a class="nav-item" href=<?= base_url("register") ?>>Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if(!empty(session()->getFlashData('success'))): ?>
            <div class="flash success-flash">
                <?= session()->getFlashData('success') ?>
            </div>
        <?php endif; ?>

        <?php if(!empty(session()->getFlashData('error'))): ?>
            <div class="flash error-flash">
                <?= session()->getFlashData('error') ?>
            </div>
        <?php endif; ?>

        <div class="main">
            <?php $this->renderSection("content") ?>
        </div>
    </body>
</html>