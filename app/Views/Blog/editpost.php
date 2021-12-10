<?php $this->extend('layout') ?>


<?php $this->section('title') ?>
    <title>Edit Post</title>
<?php $this->endsection() ?>


<?php $this->section('content') ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/newpost.css') ?>>
    <div class="upload-container">
        <h1 class="title">Edit Post</h1>
        <form method="POST">
            <?= csrf_field() ?>
            <fieldset>
                <div class="row">
                    <div class="left">
                        <label name='title' for='title'>Title: </label>
                    </div>
                    <div class="right">
                        <input name='title' type="text" value="<?= $_POST ? set_value('title') : $post['TITLE'] ?>"><br>
                    </div>
                </div>
                <div class="error-tag">
                    <?php if(isset($validation)): ?>
                        <span><?= $validation->getError('title') ?></span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="left">
                        <label name='content' for='content'>Content: </label>
                    </div>
                    <div class="right">
                        <textarea name='content'><?= $_POST ? set_value('content') : $post['CONTENT'] ?></textarea><br>
                    </div>
                </div>
                <div class="error-tag">
                    <?php if(isset($validation)): ?>
                        <span><?= $validation->getError('content') ?></span>
                    <?php endif; ?>
                </div>
                <br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </div>
<?php $this->endsection() ?>