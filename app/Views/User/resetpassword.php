<?php $this->extend('layout') ?>


<?php $this->section('title') ?>
    <title>Reset Password</title>
<?php $this->endsection() ?>


<?php $this->section('content') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/resetpassword.css') ?>">
    <h1 class="title">Reset Password</h1>
    <form action="" method="POST">
        <?= csrf_field() ?>
        <fieldset>
            <div class="row">
                <div class="left">
                    <label for='username' name='username'>Username: </label>
                </div>
                <div class="right">
                    <input name='username' type='text' value=<?= $user['USERNAME'] ?> disabled=true><br>
                </div>
            </div><br>
            <div class="row">
                <div class="left">
                    <label for='email' name='email'>Email: </label>
                </div>
                <div class="right">
                    <input name='email' type='email' value=<?= $user['EMAIL'] ?> disabled=true><br>
                </div>
            </div><br>
            <div class="row">
                <div class="left">
                    <label for='password' name='password'>Password: </label>
                </div>
                <div class="right">
                    <input name='password' type='password'><br>
                </div>
            </div>
            <div class="error-tag">
                <span class='error-msg'><?= isset($validation) ? $validation->getError('password') : "" ?></span><br>
            </div>
            <div class="row">
                <div class="left">
                    <label for='password2' name='password2'>Confirmed Password: </label>
                </div>
                <div class="right">
                    <input name='password2' type="password"><br>
                </div>
            </div>
            <div class="error-tag">
                <span class='error-msg'><?= isset($validation) ? $validation->getError('password2') : "" ?></span><br>
            </div>
            <br>
            <input type='submit' value='Submit'>
        </fieldset>
    </form>
<?php $this->endsection() ?>