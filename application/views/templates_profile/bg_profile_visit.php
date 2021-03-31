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
                        <?php foreach ($follow3 as $sk) : ?>
                            <ul class="list-inline profile-menu">
                                <li><a href="<?= base_url('profile'); ?>" class="<?= $active; ?>">Timeline</a></li>
                                <li><a href="timeline-about.html" class="<?= $active; ?>">About</a></li>
                                <li><a href=" <?= base_url('profile/following') ?>" class="<?= $active; ?>">Following</a></li>
                                <li><a href="<?= base_url('profile/followers') ?>" class="<?= $active; ?>">Followers </a></li>
                            </ul>

                            <?php foreach ($follow3 as $sk2) : ?>
                                <?php foreach ($follow2 as $sk4) : ?>
                                    <ul class="follow-me list-inline" style="margin-right: 110px;">
                                        <li>
                                            <a class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;" href="<?= base_url('chat/chat2/') . $this->uri->segment('3'); ?>">
                                                Send Message
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="follow-me list-inline">
                                        <li>
                                            <?php if ($sk4->id_userfollow == $this->session->userdata('id') and $sk2->stat == 1) : ?>
                                                <form method="post" action="<?= base_url('friend/updateUnFollow') . "/" . $this->uri->segment('3'); ?> ">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">UnFollow</button>
                                                    </a>

                                                </form>

                                            <?php elseif ($sk4->id_userfollow == $this->session->userdata('id') and $sk4->id_usertarget == $this->uri->segment('3') and $sk4->stat == 2) : ?>
                                                <form method="post" action="<?= base_url('friend/updateFollow') . "/" . $this->uri->segment('3'); ?> ">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Follow</button>
                                                </form>


                                            <?php else : ?>
                                                <form method="post" action="<?= base_url('friend/addFollow') . "/" . $this->uri->segment('3'); ?>">
                                                    <input type="hidden" name="id_usertarget" value="<?= $this->uri->segment('3') ?>">
                                                    <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="nama" value="<?= $i->name; ?>">
                                                    <input type="hidden" name="bio" value="<?= $i->bio; ?>">
                                                    <input type="hidden" name="image" value="<?= $i->image; ?>">
                                                    <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none; opacity:40%;">follow</button>
                                                </form>

                                            <?php endif; ?>


                                        </li>
                                    </ul>
                                <?php endforeach; ?>
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
            <?php endforeach; ?>
            <div class="mobile-menu">
                <ul class="list-inline">
                    <li><a href="timline.html" class="active">Timeline</a></li>
                    <li><a href="timeline-about.html">About</a></li>
                    <li><a href="timeline-album.html">Album</a></li>
                    <li><a href="timeline-friends.html">Friends</a></li>
                </ul>
                <a href="<?= base_url('user/addFollow') ?>" class="btn-primary" style="text-decoration: none;">Follow</a>
            </div>
            </div>
            <!--Timeline Menu for Small Screens End-->

        </div>