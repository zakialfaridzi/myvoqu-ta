<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <?php foreach ($following as $fw) : ?>
                <div class="chat-room" style="height: 100px;">
                    <div class="row">
                        <div class="col-md-12" style="height: 100px;">
                            <!-- Contact List in Left-->
                            <ul class=" nav nav-tabs contact-list">
                                <li class="active" style="height: 100px;">
                                    <a href="<?= base_url('friend/visitProfile/') . $fw->id_usertarget; ?> ">
                                        <div class="contact">
                                            <img src="<?= base_url('assets_user/') ?>images/<?= $fw->imagetarget; ?>" alt="" class="profile-photo-sm pull-left" />
                                            <div class="msg-preview">
                                                <h6><?= $fw->namatarget; ?></h6>
                                                <p class="text-muted"><?= $fw->biotarget; ?></p>
                                                <small class="text-muted">...</small>
                                                <!-- <div class="chat-alert" style="background-color: green">Followed</div> -->
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!--Contact List in Left End-->
                        </div>
                        <!--Chat Messages in Right End-->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>