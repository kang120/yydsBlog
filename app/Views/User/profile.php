<?php $this->extend("layout") ?>


<?php $this->section("title") ?>
    <title>Profile - <?= $user["USERNAME"] ?></title>
<?php $this->endsection() ?>


<?php $this->section("content") ?>
    <link rel="stylesheet" type="text/css" href=<?= base_url('css/profile7.css') ?>/>
    <script src=<?= base_url("js/profile3.js") ?>></script>
    <input name="isPost" type="hidden" value=<?= isset($validation) ? 1 : 0 ?>>
    <div class="profile-container">
        <div class="profile">
            <img class="profile-pic" alt=<?= $user['USERNAME'] ?> src=<?= base_url("profilepicture/" . $user['PICTURE']) ?>>
            <h1><?= $user["USERNAME"] ?></h1>
            <small><?= $user["EMAIL"] ?></small><br>
        </div>
        <?php if(session("currentUser")["USERNAME"] == $user["USERNAME"]): ?>
            <input type="button" class="edit-profile" value="edit profile" onclick="show_edit()">
            <div class="edit-panel">
                <form id="profile-edit-form" method="POST" action='' enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <fieldset>
                        <div class="row">
                            <div class="left">
                                <label for="username">Username: </label>
                            </div>
                            <div class="right">
                                <?php if(isset($validation)): ?>
                                    <input type="text" name="username" value="<?= set_value('username') ?>">
                                <?php else: ?>
                                    <input type="text" name="username" value="<?= $user['USERNAME'] ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <span class='error-tag'><?= isset($validation) ? $validation->getError('username') : "" ?></span><br>
                        <div class="row">
                            <div class="left">
                                <label for="picture">Profile picture: </label>
                            </div>
                            <div class="right">
                                <input type="file" name="picture" accept="image/*">
                            </div>
                        </div>
                        <span class='error-tag'><?= isset($validation) ? $validation->getError('email') : "" ?></span><br>
                        <br>
                        <input type="submit" value="submit">
                    </fieldset>
                </form>
            </div>
        <?php endif; ?>
        <div class="posts-panel">
            <h1>Posts</h1>
                <?php foreach($posts as $post): ?>
                    <div class="post-container" onclick="location.href='<?= base_url('post/' . $post['ID']) ?>'">
                        <div class="post-header">
                            <img class="post-profile-pic" src="<?= base_url("profilepicture/" . $user['PICTURE']) ?>">
                            <div class="post-description">
                                <small><?= $user['USERNAME'] ?></small>
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
        </div>
    </div>
<?php $this->endsection() ?>