<div class="media">
    <!-- <button type="button" class="btn btn-success" style="float: right; margin-bottom: 9px;">Upload Materi</button> -->
    <div class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>
        <div class="grid-sizer col-md-12 col-sm-12">
            <h3>Materi <?= $titleMateri->nama ?></h3>
        </div>

        <?php foreach ($materi as $mat) : ?>
            <div class="grid-item col-md-6 col-sm-6">
                <div class="media-grid">
                    <video controls>
                        <source src="<?= base_url('assets_user/file_upload/') . $mat['filename'] ?>" type="video/mp4">
                    </video>
                    <div class="media-info">
                    <?php if ($mat['id_user'] == $this->session->userdata('id')) { ?>
                        <a href="<?= base_url('Library/hapusMateri/') . $mat['id_post_m'] . '/' . $mat['id_surat'] ?>" class="label label-danger pull-right">Hapus</a>
                    <?php } ?>
                        <div class="user-info">
                            <!-- <?php var_dump($this->session->userdata()); ?> -->
                            <img src="<?= base_url('assets_user/'); ?>images/<?= $mat['image']; ?>" alt="" class="profile-photo-sm pull-left" />
                            <div class="user">
                                <h5><?= $mat['nama']; ?></h5>
                                <h5>oleh <a href="<?= base_url('Friend/visitProfile/') . $mat['id_user'] ?>" class="profile-link"><?= $mat['name']; ?></a></h5>
                                <p>
                                    <!-- <a href="#" id="lihat-komen" data-idmp="<?= $mat['id_post_m']; ?>" data-toggle="modal" data-target="#myModal<?= $mat['id_post_m']; ?>">Lihat komentar</a> -->
                                    <a href="#" onclick="getCommentMateri(<?= $mat['id_post_m']; ?>)" data-toggle="modal" data-target="#myModal<?= $mat['id_post_m']; ?>">Lihat komentar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal<?= $mat['id_post_m']; ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="post-content">
                            <!-- <img src="images/post-images/1.jpg" alt="post-image" class="img-responsive post-image" /> -->
                            <video controls>
                                <source src="<?= base_url('assets_user/file_upload/') . $mat['filename'] ?>" type="video/mp4">
                            </video>
                            <div class="post-container">
                                <img src="<?= base_url('assets_user/'); ?>images/<?= $mat['image']; ?>" alt="user" class="profile-photo-md pull-left" />
                                <div class="post-detail">
                                    <div class="user-info">
                                        <h5><a href="<?= base_url('Friend/visitProfile/') . $mat['id_user'] ?>" class="profile-link"><?= $mat['name']; ?></a></h5>
                                        <p class="text-muted">diunggah <?= $mat['date_post']; ?></p>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-text">
                                        <p><?= $mat['nama']; ?></p>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div id="list-comment<?= $mat['id_post_m']; ?>">
                    
                                    </div>
                                    <div class="post-comment">
                                        <img src="<?= base_url('assets_user/'); ?>images/<?= $this->session->userdata('image') ?>" alt="" class="profile-photo-sm" />
                                        <input type="text" id="input-comment<?= $mat['id_post_m']; ?>" class="form-control" placeholder="berikan komentar">&nbsp;
                                        <button id="post-comment" onclick="addCommentMateri(<?= $mat['id_post_m']; ?>)" class="btn-primary">Kirim</button>
                                    </div>
                                    <button type="button" id="tutup-modal" data-idmp="<?= $mat['id_post_m']; ?>" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!--Popup-->
        <!-- <div id="" class="modal fade modal-1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="post-content">
                        <div class="video-wrapper">
                            <video controls>
                                <source src="videos/3.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Popup End-->

    </div>
</div>
<center><?= $this->pagination->create_links(); ?></center>
</div>