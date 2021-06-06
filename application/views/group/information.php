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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalInfo">Buat Informasi</button>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Buat Tugas Hafalan</button>
                            <?php
                            }
                            ?>
                            <ul class=" nav nav-tabs contact-list">
                                <li class="active">
                                    <?php foreach ($allinfo as $info) { ?>
                                        <div class="contact" style="margin-top: 30px;">
                                            <img src="<?= base_url('assets_user/images/') . $this->session->userdata('image') ?>" alt="" class="profile-photo-sm pull-left" />
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
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Informasi Tugas Hafalan</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('Group/tambahInfo/tugas/') . $this->uri->segment('3'); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" value="<?= $this->session->userdata('id'); ?>" name="iduser" id="iduser" hidden>
                                    <label for="nama">Nama Surah</label>
                                    <input type="text" name="nama" class="form-control" id="nama_surah" placeholder="Pilih Surah Contoh : Al-Fatihah" list="list-surah" required>
                                    <datalist id="list-surah">
                                        <!-- <option value="Internet Explorer"> -->
                                    </datalist>
                                    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                    <label for="fromAyat">Ayat ke</label>
                                    <select name="fromAyat" class="form-control" id="list-ayat" required>
                                        <!-- <option value="Internet Explorer"> -->
                                    </select>
                                    <label for="toAyat">Sampai Ayat :</label>
                                    <select name="toAyat" class="form-control" id="list-ayat2">
                                        <!-- <option value="Internet Explorer"> -->
                                    </select>
                                    <small class="form-text text-danger"><?= form_error('ayat'); ?></small>
                                    <label for="catatan">Catatan</label>
                                    <input type="text" name="catatan" class="form-control" id="catatan" placeholder="(Opsional) Tambahkan Catatan">
                                    <small class="form-text text-danger"><?= form_error('catatan'); ?></small>
                                    <input type="hidden" name="hafalan" class="form-control" value="1">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="modalInfo" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Buat Informasi</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('Group/tambahInfo/info/') .  $this->uri->segment('3'); ?>" method="POST">
                            <div class="form-group">
                                <form action="<?= base_url('user/posting'); ?>" method="post" enctype="multipart/form-data">
                                    <input type="text" value="<?= $this->session->userdata('id'); ?>" name="iduser" id="iduser" hidden>
                                    <textarea cols="30" rows="3" class="form-control" placeholder="Write the information" name="informasi" id="informasi" required></textarea>
                                    <?= form_error('caption', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        