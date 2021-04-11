<?php foreach ($info as $i): ?>



<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">

            <!-- Post Create Box
              ================================================= -->

            <div class="create-post">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="form-group">
                            <img src="<?=base_url('assets_user/')?>images/<?=$i->image;?>" alt=""
                                class="profile-photo-md" />
                            <form action="<?=base_url('profile/posting');?>" method="post"
                                enctype="multipart/form-data">
                                <textarea cols="30" rows="1" class="form-control" placeholder="Masukkan kata-kata"
                                    name="caption" id="caption"></textarea>
                                <?=form_error('caption', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="tools">
                            <ul class="publishing-tools list-inline">
                                <li class="nav-item">
                                    <label for="file-input-gambar">
                                        <a class="nav-link"><i class="fas fa-photo-video"></i></a>
                                    </label>
                                    <input type="file" id="file-input-gambar" style="display: none;" name="file">
                                </li>



                            </ul>
                            <button class="btn btn-primary pull-right"
                                style="background-color: #6fb8df;outline: none;">Unggah</button>

                            <input type="hidden" value="<?=$this->session->userdata('id');?>" name="id_user"
                                id="id_user">
                            </form>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div><!-- Post Create Box End-->
            <?=$this->session->flashdata('message');?>

            <!-- Post Content
              ================================================= -->

            <?=$this->session->flashdata('mm');?>



            <?php foreach ($posting as $pst): ?>



            <div class="post-content">

                <div class="post-date hidden-xs hidden-sm">
                    <h5></h5>

                </div>

                <input type="hidden" value="<?=$pst->id_posting;?>" id="id_post">


                <?=$pst->html;?>

                <?php if ($pst->id_user != $this->session->userdata('id')): ?>


                <i class="fas fa-exclamation" style="color: tomato;margin-left:10px;"></i>
                <a href="" style="text-decoration:none;">Laporkan</a>


                <?php else: ?>

                <i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
                <a href="<?=base_url();?>profile/deletePost/<?=$pst->id_posting;?>" style="text-decoration:none;"
                    id="delete">Hapus</a>


                <?php endif;?>

                <div class="post-container">
                    <img src="<?=base_url('assets_user/');?>images/<?=$pst->image;?>" alt="user"
                        class="profile-photo-md pull-left" />
                    <div class="post-detail">
                        <div class="user-info">
                            <h5 class="text-info"><?=$pst->name;?></h5>
                            <p class="text-muted">Diunggah pada <?=date('d F Y ', $pst->date_post);?></p>
                        </div>

                        <div class="line-divider"></div>
                        <div class="post-text">
                            <p><?=$pst->caption;?> </p>
                        </div>
                        <div class="line-divider"></div>

                        <div class="post-comment">
                            <a href="<?=base_url('user/getIdposting/') . $pst->id_posting;?>">Komen</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach;?>


            <!-- Post Content
              ================================================= -->


            <!-- Post Content
              ================================================= -->


        </div>
