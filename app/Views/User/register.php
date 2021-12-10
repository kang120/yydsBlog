<?php $this->extend("layout") ?>


<?php $this->section("title") ?>
    <title>YYDS-Register</title>
<?php $this->endSection() ?>


<?php $this->section("content") ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/register3.css') ?>/>
    <div class="section-title">Register</div>
    <form id="reg-form" method="POST" action="register">
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
                    <label for="email">Email: </label>
                </div>
                <div class="right">
                    <input type="text" name="email" value=<?= set_value('email') ?>>
                </div>
            </div>
            <span class='error-msg'><?= isset($validation) ? $validation->getError('email') : "" ?></span><br>
            <div class="row">
                <div class="left">
                    <label for="password">Password: </label>
                </div>
                <div class="right">
                    <input type="password" name="password" value=<?= set_value('password') ?>>
                </div>
            </div>
            <span class='error-msg'><?= isset($validation) ? $validation->getError('password') : "" ?></span><br>
            <div class="row">
                <div class="left">
                    <label for="password2">Confirmed Password: </label>
                </div>
                <div class="right">
                    <input type="password" name="password2" value=<?= set_value('password2') ?>>
                </div>
            </div>
            <span class='error-msg'><?= isset($validation) ? $validation->getError('password2') : "" ?></span><br>
            <div class="row">
                <input type="submit" value="Sign up">
            </div>
            <hr>
            <span>Already has an account?</span>
            <a class="login" href="login">Sign in</a>
        </fieldset>
    </form>

<?php $this->endSection() ?>