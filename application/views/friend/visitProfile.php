<?php foreach ($info as $i) : ?>



    <div id="page-contents">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-7">

                <!-- Post Create Box
          ================================================= -->



            <?php endforeach; ?>


            <?= $this->session->flashdata('message'); ?>

            <!-- Post Content 
          ================================================= -->

            <?= $this->session->flashdata('mm'); ?>



            <?php foreach ($posting as $pst) : ?>



                <div class="post-content">


                    <input type="hidden" value="<?= $pst->id_posting; ?>" id="id_post">


                    <?= $pst->html; ?>

                    <?php if ($pst->id_user != $this->session->userdata('id')) : ?>

<?php if ($pst->id_user != $this->session->userdata('id')) : ?>
    <form method="post" action="<?= base_url('User/addReport'); ?>">
        <input type="hidden" name="id_posting" value="<?= $pst->id_posting; ?>">
        <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
        <a class="btn text-red">
            <button class="fas fa-exclamation" style="border : 0;" name="report"> Laporkan! </button> </a>
    </form>
<?php elseif ($pst->id_user != $this->session->userdata('id') and $rpt->report == 1) : ?>

<?php endif; ?>

<?php else : ?>

<i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
<a href="<?= base_url(); ?>user/deletePost/<?= $pst->id_posting; ?>" style="text-decoration:none;">Hapus</a>

<?php endif; ?>

                    <div class="post-container">
                        <img src="<?= base_url('assets_user/'); ?>images/<?= $pst->image; ?>" alt="user" class="profile-photo-md pull-left" />
                        <div class="post-detail">
                            <div class="user-info">
                                <h5><a href="<?=base_url('friend/visitProfile/') . $pst->id_user;?>" class="profile-link"><?= $pst->name; ?></></h5>
                                <p class="text-muted">Diunggah pada <?= date('d F Y ', $pst->date_post); ?></p>
                            </div>


                            <div class="line-divider"></div>
                            <div class="post-text">
                                <p><?= $pst->caption; ?> </p>
                            </div>
                            <div class="line-divider"></div>
                            <div class="post-comment">
                                <a href="<?= base_url('user/getIdposting/') . $pst->id_posting; ?>">Beri Komentar</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>


            <!-- Post Content
          ================================================= -->


            <!-- Post Content
          ================================================= -->


            </div>