<!--Header End-->

<div id="page-contents">
    <div class="container">
        <div class="row">

            <!-- Newsfeed Common Side Bar Left
          ================================================= -->
            <?php foreach ($allUser as $us): ?>
            <div class="col-md-3 static">

                <div class="profile-card">
                    <img src="<?=base_url('assets_user/images/' . $us->image);?> " alt="user" class="profile-photo" />
                    <h5><a href="<?=base_url('profile')?>" class="text-white"><?=$us->name;?></a>
                        <?php if ($us->role_id == 3) {?>
                        <span class="badge badge-secondary">Mentor</span>
                        <?php }?>
                    </h5>
                    <?php foreach ($jumlahfollowers as $jf): ?>
                    <a href="<?=base_url('profile/followers');?>" class="text-white"><i
                            class="ion ion-android-person-add"></i><?=$jf->jumlahfollowers;?>
                        followers</a>
                    <?php endforeach;?>
                </div>
                <!--profile card ends-->
                <div style="">
                    <ul class="nav-news-feed">

                        <li><i class="far fa-bell" style="color: tomato;"></i>
                            <div><a href="<?=base_url('notification')?>">Notifikasi</a></div>
                        </li>

                        <li><i class="fas fa-book-reader" style="color: burlywood;"></i>
                            <div><a href="<?=base_url('library')?>">Material Pembelajaran</a></div>
                        </li>

                        <li><i class="fas fa-search" style="color: peachpuff;"></i>
                            <div><a href="<?=base_url('friend')?>">Temukan Teman</a></div>
                        </li>

                        <li><i class="fas fa-users" style="color: royalblue;"></i>
                            <div><a href="<?=base_url('group')?>">Grup</a></div>
                        </li>

                        <li><i class="fas fa-comments" style="color: yellowgreen;"></i>
                            <div><a href="<?=base_url('chat/index');?>">Pesan</a></div>
                        </li>

                        <li><i class="fas fa-comment-dots" style="color: black;"></i>
                            <div><a href="<?=base_url('./Chat');?>" target="_blank">Ngobrol Dengan Semua Pengguna</a>
                            </div>
                        </li>

                        <li><i class="fa fa-video text-muted" style="color: black;"></i>
                            <div><a href="<?=base_url('./Colab');?>" target="_blank">Kolaborasi</a></div>
                        </li>

                    </ul>
                    <!--news-feed links ends-->
                    <div id="container1">
                        <div id="chat-block">
                            <div class="title">Pengguna Online</div>
                            <ul class="online-users list-inline">
                                <?php foreach ($otherUser as $ou):
    if ($ou->role_id != 1) {?>
                                <li>
                                    <a href="newsfeed-messages.html" title="<?=$ou->name;?>"><img
                                            src="<?=base_url('assets_user/images/' . $ou->image);?>" alt="user"
                                            class="img-responsive profile-photo" /><span class="<?=$ou->status;?>"
                                            id="keyword"></span>
                                    </a>
                                </li>
                                <?php }
endforeach;?>

                            </ul>
                        </div>
                    </div>
                </div>
                <!--chat block ends-->
            </div>
            <div class="col-md-7">

                <!-- Post Create Box
            ================================================= -->
                <div class="create-post">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="form-group">
                                <img src="<?=base_url('assets_user/images/' . $us->image);?>" alt=""
                                    class="profile-photo-md" />
                                <form action="<?=base_url('user/posting');?>" method="post"
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
                                    style="background-color:#6fb8df;">Unggah</button>
                                <input type="hidden" value="<?=$this->session->userdata('id');?>" name="id_user"
                                    id="id_user">
                                <?php foreach ($idpost as $idpst): ?>
                                <input type="hidden" value="<?=$idpst->id_posting;?>" name="id_posting">
                                <?php endforeach;?>
                                </form>
                            </div>
                            <?php endforeach;?>
                        </div>

                    </div>
                </div><!-- Post Create Box End-->
                <?=$this->session->flashdata('message');?>