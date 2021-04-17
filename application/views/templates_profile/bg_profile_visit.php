<div class="container">
 
    <!-- Timeline
      ================================================= -->
    <div class="timeline">
        <div class="timeline-cover">
 
            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-info">
                            <?php foreach ($info as $i) : ?>
                                <img src="<?= base_url('assets_user/') ?>images/<?= $i->image; ?>" alt="" class="img-responsive profile-photo" />
                                <h3 style="color: #6fb8df;"><?= $i->name; ?></h3>
                                <p class="text-muted"><?= $i->work; ?></p>
                        </div>
                    </div>
                    <div class="col-md-9">
                            <ul class="list-inline profile-menu">
                                <li><a href="<?=base_url('friend/visitProfile/') .$this->uri->segment('3'); ?> " class="<?= $active; ?>">Lintas Masa</a></li>
                                <li><a href="<?=base_url('friend/aboutMeVisit/') .$this->uri->segment('3'); ?>" class="<?= $active; ?>">Tentang</a></li>
                                <li><a href=" <?= base_url('friend/followingvisit') . "/" . $this->uri->segment('3'); ?>" class="<?= $active; ?>">Diikuti</a></li>
                                <li><a href="<?= base_url('friend/followersvisit') . "/" . $this->uri->segment('3'); ?>" class="<?= $active; ?>">Pengikut </a></li>
                            </ul>


                                <?php foreach ($pollow as $fl) : ?>
                                    <ul class="follow-me list-inline" style="margin-right: 110px;">
                                        <li>
                                            <a class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; margin-right:80px; outline: none;" href="<?= base_url('chat/chat2/') . $this->uri->segment('3'); ?>">
                                                Kirim Pesan
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="follow-me list-inline">
                                        <li>
                                            <?php if($fl->id_userfollow == $this->session->userdata('id') and $fl->id_usertarget == $this->uri->segment('3') and $fl->stat == 1) : ?>
                                                <form method="post" action="<?= base_url('friend/updateUnFollow') . "/" . $this->uri->segment('3'); ?> ">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="notiffollow" value="<?= $i->name; ?> Berhenti Mengikuti anda">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Berhenti Mengikuti</button>
                                                    </a>

                                                </form>

                                            <?php elseif($fl->id_userfollow == $this->session->userdata('id') and $fl->id_usertarget == $this->uri->segment('3') and $fl->stat == 2) : ?>
                                                <form method="post" action="<?= base_url('friend/updateFollow') . "/" . $this->uri->segment('3'); ?> ">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="notiffollow" value="<?= $i->name; ?> Mengikuti anda">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ikuti lagi pengguna?</button>
                                                </form>

                                            <?php elseif($fl->id_userfollow == $this->session->userdata('id') and $fl->id_usertarget == $this->session->userdata('id')) : ?>
                                                <form method="post" action="<?= base_url('friend/addFollow') . "/" . $this->uri->segment('3'); ?>">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="notiffollow" value="<?= $i->name; ?> Mengikuti anda">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ikuti pengguna</button>
                                                </form>

                                            <?php endif ?>

                                        </li>
                                    </ul>
                            <?php endforeach; ?>
                            <?php endforeach; ?>
                            


                    </div>
                </div>
            </div>
            <!--Timeline Menu for Large Screens End-->


            <!--Timeline Menu for Small Screens-->
            <div class="navbar-mobile hidden-lg hidden-md">
				<div class="profile-info">
					<img src="<?= base_url('assets_user/') ?>images/<?= $i->image ?>" alt="" class="img-responsive profile-photo" />
					<h4><?= $i->name; ?></h4>
					<p class="text-muted"><?= $i->work; ?></p>
				</div>
			<div class="mobile-menu">
				<ul class="list-inline">
                <li><a href="<?=base_url('friend/visitProfile/') .$this->uri->segment('3'); ?> " class="<?= $active; ?>">Lintas Masa</a></li>
                <li><a href="<?=base_url('friend/aboutMeVisit/') .$this->uri->segment('3'); ?>" class="<?= $active; ?>">Tentang</a></li>
                <li><a href=" <?= base_url('friend/followingvisit') . "/" . $this->uri->segment('3'); ?>" class="<?= $active; ?>">Diikuti</a></li>
                <li><a href="<?= base_url('friend/followersvisit') . "/" . $this->uri->segment('3'); ?>" class="<?= $active; ?>">Pengikut </a></li>
				</ul>
				<tr style="height: 50px;">
                <td>
                <ul class="follow-me list-inline">
                                        <li>
                                            <a class="btn btn-primary" style="background-color: #6fb8df; color:white; outline: none;" href="<?= base_url('chat/chat2/') . $this->uri->segment('3'); ?>">
                                                Kirim Pesan
                                            </a>
                                        </li>
                                        <li>
                </td>
                <td>
                <?php foreach ($pollow as $fl) : ?>
                                        <?php if($fl->id_userfollow == $this->session->userdata('id') and $fl->id_usertarget == $this->uri->segment('3') and $fl->stat == 1) : ?>
                                                <form method="post" action="<?= base_url('friend/updateUnFollow') . "/" . $this->uri->segment('3'); ?> ">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="notiffollow" value="<?= $i->name; ?> Berhenti Mengikuti anda">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; ; outline: none;">Berhenti Mengikuti</button>
                                                    </a>

                                                </form>

                                            <?php elseif($fl->id_userfollow == $this->session->userdata('id') and $fl->id_usertarget == $this->uri->segment('3') and $fl->stat == 2) : ?>
                                                <form method="post" action="<?= base_url('friend/updateFollow') . "/" . $this->uri->segment('3'); ?> ">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="notiffollow" value="<?= $i->name; ?> Mengikuti anda">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; ; outline: none;">Ikuti lagi pengguna?</button>
                                                </form>

                                            <?php elseif(is_null($fl->id_userfollow == $this->session->userdata('id') and $fl->id_usertarget == $this->uri->segment('3'))): ?>
                                                <form method="post" action="<?= base_url('friend/addFollow') . "/" . $this->uri->segment('3'); ?>">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="notiffollow" value="<?= $i->name; ?> Mengikuti anda">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; outline: none;">Ikuti pengguna</button>
                                                </form>
                                            <?php endif; ?>
                                    <?php endforeach; ?>
                                        </li>
                                    </ul>
                </td>
                </tr>
                                    
                    
                                    
                            

			</div>
			</div>


        </div>
            
        