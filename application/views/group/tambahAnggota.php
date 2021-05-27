<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <?= $this->session->flashdata('msg'); ?>
            <a href="<?= base_url(); ?>group/listAnggota/<?= $this->uri->segment('3'); ?>" style="text-decoration:none; float: left;">
                <h4><span class="label label-primary"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</span></h4>
            </a>
            <br><br>
            <div class="chat-room">
                <div class="row">
                    <?php foreach ($cek as $user) {
                        if ($user['gender'] == $this->session->userdata('gender')) {
                    ?>
                            <div class="col-md-4 col-sm-4">
                                <div class="friend-card">
                                    <img src="<?= base_url('assets_user/'); ?>images/covers/1.jpg" alt="profile-cover" class="img-responsive cover">
                                    <div class="card-info">
                                        <img src="<?= base_url('assets_user/') ?>images/<?= $user['image']; ?>" alt="user" class="profile-photo-lg">
                                        <div class="friend-info">
                                            <a href="<?= base_url('group/inviteUser/') . $this->uri->segment('3') . '/' . $user['id']; ?>" class="btn btn-success pull-right">Undang</a>
                                            <h5><a href="<?= base_url('friend/visitProfile/') . $user['id']; ?>" class="profile-link"><?= $user['name']; ?></a></h5>
                                            <p><?= $user['bio']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
        <script src="<?= base_url('assets_user/js/search.js'); ?>"></script>