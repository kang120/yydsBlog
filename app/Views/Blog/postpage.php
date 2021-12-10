<?php $this->extend('layout') ?>


<?php $this->section('title') ?>
    <title><?= $post['TITLE'] ?></title>
<?php $this->endsection() ?>


<?php $this->section('content') ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/home4.css') ?>/>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/postpage.css') ?>/>
    <script src=<?= base_url('js/profile.js') ?>></script>

    <div class="modal-container" id="confirmation">
        <div class="modal-dialog">
            <div class="modal-header">
                <h2 class="modal-title">Are you sure to delete post?</h2>
            </div>
            <div class="modal-body">
                <button onclick="close_modal()">cancel</button>
                <form action=<?= base_url('post/delete/' . $post['ID']) ?> method="POST">
                    <input type="submit" value="delete">
                </form>
            </div>
        </div>
    </div>

    <div class="post-container-page" style="width: 100%;">
        <div class="post-header">
            <a href=<?= base_url('profile/' . $author['USERNAME']) ?>>
                <img class="profile-pic" src=<?= base_url('profilepicture/' . $author['PICTURE']) ?>>
            </a>
            <div class="post-description">
                <a href=<?= base_url('profile/' . $author['USERNAME']) ?>><?= $author['USERNAME'] ?></a>
                <div class="post-date"><small><?= $post['DATE'] ?></small></div>
            </div>
            <?php if(session()->get('currentUser') != NULL && $author['ID'] == session()->get('currentUser')['ID']): ?>
                <div class="edit-post">
                    <button onclick="location.href='<?= base_url('post/edit/' . $post['ID']) ?>'">edit</button>
                    <button onclick="show()">delete</button>
                </div>
            <?php endif; ?>
        </div>
        <hr>
        <div class="post-body">
            <h1><?= $post['TITLE'] ?></h1>
            <p><?= $post['CONTENT'] ?></p>
        </div>
    </div>
<?php $this->endsection() ?>