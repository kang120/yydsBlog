<?php $this->extend("layout") ?>


<?php $this->section("title") ?>
    <title>YYDS-Logout</title>
<?php $this->endsection() ?>


<?php $this->section("content") ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/login3.css') ?>/>
    <div style="margin-top: 20px;">
        You have logged out.
        <a class="login" href="login">Sign in</a>
    </div>
<?php $this->endsection() ?>