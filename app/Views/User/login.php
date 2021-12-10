<?php $this->extend("layout") ?>



<?php $this->section("title") ?>
    <title>YYDS-Login</title>
<?php $this->endSection() ?>


<?php $this->section("content") ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/login3.css') ?>/>
    <div class="section-title">Login</div>
    <form id="login-form" method="POST" action="login">
        <?= csrf_field() ?>
        <fieldset>
            <div class="row">
                <div class="left">
                    <label for="username">Username: </label>
                </div>
                <div class="right">
                    <input type="text" name="username" value=<?= set_value('username') ?>>
                </div>
            </div>
            <span class='error-msg'><?= isset($validation) ? $validation->getError('username') : "" ?></span><br>
            <div class="row">
                <div class="left">
                    <label for="password">Password: </label>
                </div>
                <div class="right">
                    <input type="password" name="password" value=<?= set_value('password') ?>>
                </div>
            </div>

            <?php if(isset($validation)): ?>
                <span class='error-msg'><?= $validation->getError('password') ?></span>
            <?php endif; ?>

            <?php if(isset($password_error)): ?>
                <span class='error-msg'><?= $password_error ?></span>
            <?php endif; ?>
            <br>

            <div class="row">
                <input type="submit" value="Sign in">
            </div>
            <hr>
            <span>Don't have account?</span>
            <a class="login" href="<?= base_url('register') ?>">Sign up</a><br>
            <a class="forgot-password" href="<?= base_url('reset/request') ?>">Forgot password?</a>
        </fieldset>
    </form>

<?php $this->endSection() ?>