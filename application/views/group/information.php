<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->

            <?= $this->session->flashdata('message'); ?>

            <!-- Post Content
         ================================================= -->

            <?= $this->session->flashdata('mm'); ?>
            <div>
                <div class="chat-room">
                    <div class="row">
                    <a href="<?= base_url(); ?>group/ingroup/<?= $this->uri->segment('3'); ?>" style="text-decoration:none; float: left;">
                        <h4><span class="label label-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</span></h4>
                    </a>
                    <br>
                        <h3>Informasi</h3>
                        <div class="col-md-12">
                            <!-- Contact List in Left-->
                            <?php if ($user['role_id'] == 3) {
                                ?>
                                <form action="<?= base_url('Group/tambahInfo')."/".$this->uri->segment('3'); ?>" method="POST">
                                    <div class="form-group">
                                        <form action="<?= base_url('user/posting'); ?>" method="post" enctype="multipart/form-data">
                                            <input type="text" value="<?= $this->uri->segment('3'); ?>" name="idgroup" id="idgroup" hidden>
                                            <input type="text" value="<?= $this->session->userdata('id'); ?>" name="iduser" id="iduser" hidden>
                                            <textarea cols="30" rows="3" class="form-control" placeholder="Write the information" name="informasi" id="informasi"></textarea>
                                            <?= form_error('caption', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button class="btn btn-primary pull-right" style="background-color:#6fb8df;">Publish</button>
                                </form>
                            <?php
                            }
                            ?>
                            <ul class=" nav nav-tabs contact-list">
                                <li class="active">
                                    <?php foreach ($allinfo as $info) { ?>
                                        <div class="contact" style="margin-top: 30px;">
                                            <img src="<?= base_url('assets_user/') ?>images/default.png" alt="" class="profile-photo-sm pull-left" />
                                            <div class="msg-preview">
                                                <!-- nama -->
                                                <h5 style="margin-left: 50px;"><?= $info['name']; ?> <span class="badge badge-primary">Mentor</span><br>
                                                    <small class="text-muted">
                                                        <?= $info['date_post']; ?>
                                                    </small>
                                                </h5>
                                                <!-- isi info -->
                                                <p class="text-muted" style="margin-left: 50px;">
                                                    <?= $info['info']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </li>
                            </ul>
                            <!--Contact List in Left End-->
                        </div>
                        <!--Chat Messages in Right End-->
                    </div>
                </div>

            </div>


        </div>