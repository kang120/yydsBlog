<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>YYDS</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/home4.css') ?>/>
    <?php if(!empty($posts)): ?>
        <?php foreach($posts as $post): ?>
            <div class="post-container" onclick="location.href='<?= base_url('post/' . $post['ID']) ?>'">
                <div class="post-header">
                    <a href=<?= base_url('profile/' . $post['USERNAME']) ?>>
                        <img class="profile-pic" src="<?= base_url('profilepicture/' . $post['PICTURE']) ?>">
                    </a>
                    <div class="post-description">
                        <a href=<?= base_url('profile/' . $post['USERNAME']) ?>><?= $post['USERNAME'] ?></a>
                        <div class="post-date"><small><?= $post['DATE'] ?></small></div>
                    </div>
                </div>
                <hr>
                <div class="post-body">
                    <h1><?= $post['TITLE'] ?></h1>
                    <p><?= $post['CONTENT'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>No post here</h3>
    <?php endif; ?>
        
    <div class='pager-container'>
        <?= $pager->links() ?>
    </div>
<?php $this->endSection() ?>