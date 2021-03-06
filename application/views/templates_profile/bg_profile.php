<div class="container">

    <!-- Timeline
      ================================================= -->
    <div class="timeline">
        <div class="timeline-cover">

            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs" style="background-color: darkslateblue;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-info">
                            <?php foreach ($info as $i): ?>
                            <img src="<?=base_url('assets_user/')?>images/<?=$i->image;?>" alt=""
                                class="img-responsive profile-photo" />
                            <h3 style="color: #6fb8df;"><?=$i->name;?></h3>
                            <p class="text-muted"><?=$i->work;?></p>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <ul class="list-inline profile-menu">
                            <li><a href="<?=base_url('profile');?>" class="<?=$active;?>" style="color: #fff;">Lintas
                                    Masa</a></li>
                            <li><a href="<?=base_url('profile/aboutMe');?>" class="<?=$active;?>"
                                    style="color: #fff;">Tentang</a></li>
                            <li><a href=" <?=base_url('profile/following')?>" class="<?=$active;?>"
                                    style="color: #fff;">Diikuti</a></li>
                            <li><a href="<?=base_url('profile/followers')?>" class="<?=$active;?>"
                                    style="color: #fff;">Pengikut</a></li>
                        </ul>
                        <ul class="follow-me list-inline">

                            <li>
                                <a href="<?=base_url('profile/editProfile');?>" class="btn btn-primary"
                                    style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ubah Profil</a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
            <!--Timeline Menu for Large Screens End-->

            <!--Timeline Menu for Small Screens-->
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                    <img src="<?=base_url('assets_user/')?>images/<?=$i->image?>" alt=""
                        class="img-responsive profile-photo" />
                    <h4><?=$i->name;?></h4>
                    <p class="text-muted"><?=$i->work;?></p>
                </div>
                <?php endforeach;?>
                <div class="mobile-menu">
                    <ul class="list-inline">
                        <li><a href="<?=base_url('profile');?>" class="<?=$active;?>">Lintas Masa</a></li>
                        <li><a href="<?=base_url('profile/aboutMe');?>" class="<?=$active;?>">Tentang</a></li>
                        <li><a href=" <?=base_url('profile/following')?>" class="<?=$active;?>">Diikuti</a></li>
                        <li><a href="<?=base_url('profile/followers')?>" class="<?=$active;?>">Pengikut</a></li>
                    </ul>
                    <a href="<?=base_url('profile/editProfile');?>" class="btn btn-primary"
                        style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ubah Profil</a>
                </div>
            </div>
            <!--Timeline Menu for Small Screens End-->

        </div>
