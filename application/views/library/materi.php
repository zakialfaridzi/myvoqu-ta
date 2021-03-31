<div class="media">
    <!-- <button type="button" class="btn btn-success" style="float: right; margin-bottom: 9px;">Upload Materi</button> -->
    <div class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>
        <div class="grid-sizer col-md-12 col-sm-12"></div>
        <?php foreach ($materi as $mat) : ?>
            <div class="grid-item col-md-6 col-sm-6">
                <div class="media-grid">
                        <video controls>
                            <source src="<?= base_url('assets_user/file_upload/').$mat['filename'] ?>" type="video/mp4">
                        </video>
                    <div class="media-info">
                        <div class="user-info">
                            <img src="images/users/user-10.jpg" alt="" class="profile-photo-sm pull-left" />
                            <div class="user">
                                <h5><?= $mat['nama']; ?></h5>
                                <h5>Oleh Ustad <a href="<?= base_url('Friend/visitProfile/').$mat['id_user'] ?>" class="profile-link"><?= $mat['name']; ?></a></h5>
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