<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>About</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link type='text/css' rel="stylesheet" href="<?= base_url('css/about2.css') ?>"/>
    <div class='about-title'>YYDS Team Members</div>
    <div class="member-picture-container">
        <?php foreach($members as $member): ?>
            <div class="member-picture-box">
                <img class="member-picture" alt="<?= $member['name'] ?>" src="<?= base_url('memberpicture/' . $member['picture']) ?>"><br>
                <?= $member['name'] ?><br>
                <?= $member['id'] ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php $this->endSection() ?>