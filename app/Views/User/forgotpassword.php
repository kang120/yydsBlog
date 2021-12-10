<?php $this->extend('layout') ?>


<?php $this->section('title') ?>
    <title>Forgot Password</title>
<?php $this->endsection() ?>


<?php $this->section('content') ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/forgotpassword.css') ?>>
    <div class="section-title">Reset Password</div>
    <form action="" method="POST">
        <?= csrf_field() ?>
        <fieldset>
            <div class="row">
                <div class="left">
                    <label name="email" for="email">Email: </label>
                </div>
                <div class="right">
                    <input name="email" type="email" value="<?= $_POST ? $_POST['email'] : '' ?>">
                </div>
            </div>
            <div class="error-tag">
                <?php if(isset($validation)): ?>
                    <span class='error-msg'><?= $validation->getError('email') ?></span>
                <?php endif; ?>
            </div>
            <br>
            <input type='submit' value='submit'>
        </fieldset>
    </form>
<?php $this->endsection('content') ?>