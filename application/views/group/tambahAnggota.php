<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <a href="<?= base_url(); ?>group/listAnggota/<?= $this->uri->segment('3'); ?>" style="text-decoration:none; float: left;">
                <h4><span class="label label-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</span></h4>
            </a>
                    <br><br>
                    <?php foreach ($cek as $user) { 
                        if ($user['gender'] == $this->session->userdata('gender')) {
                    ?>
                        <div class="col-md-4 col-sm-6" style="margin-top: 20px;">
                            <div class="friend-card">
                                <img src="<?= base_url('assets_user/'); ?>images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                                <div class="card-info" style="height: 50%">
                                    <img src="<?= base_url('assets_user/') ?>images/<?= $user['image']; ?>" alt="user" class="profile-photo-lg" />
                                    <form method="post" action="<?= base_url('group/inviteUser') . "/" . $this->uri->segment('3'); ?>">
                                        <div class="friend-info">
                                            <?php foreach ($datagroup as $idgroup) : ?>
                                                <!-- <input type="hidden" value="<?= $idgroup['id']; ?>" name="idgroup"> -->
                                                <input type="hidden" value="<?= $user['id']; ?>" name="iduser">
                                                <button type="submit" class="btn btn-success" style="margin-left: 68%; height: 25px; margin-top: 10px;">
                                                    <p style="margin-top: -6px;">Invite</p>
                                                </button>
                                            <?php endforeach; ?>
                                            <div style="margin-top: -30px;">
                                                <h5><a href="timeline.html" class="profile-link"><?= $user['name']; ?></a></h5>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    <!-- <div class="col-md-7">
            <br>
            <h3>Mentor</h3>
            <div class="col-md-4 col-sm-6" style="margin-top: 20px;">
                    <div class="friend-card">
                        <img src="<?= base_url('assets_user/'); ?>images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                        <div class="card-info" style="height: 50%">
                            <img src="<?= base_url('assets_user/') ?>images/" alt="user" class="profile-photo-lg" />
                            <form method="post" action="<?= base_url(); ?>group/inviteUser">
                                <div class="friend-info">
                                    <!-- <?php foreach ($datagroup as $idgroup) : ?> -->
                    <!-- <input type="hidden" value="" name="idgroup">
                                        <input type="hidden" value="" name="iduser">
                                        <button type="submit" class="btn btn-success" style="margin-left: 68%; height: 25px; margin-top: 10px;">
                                            <p style="margin-top: -6px;">Invite</p>
                                        </button> -->
                    <!-- <?php endforeach; ?> -->
                    <!-- <div style="margin-top: -30px;">
                                        <h5><a href="timeline.html" class="profile-link">SI MENTOR</a></h5>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div> -->
        </div>
        <script src="<?= base_url('assets_user/js/search.js'); ?>"></script>