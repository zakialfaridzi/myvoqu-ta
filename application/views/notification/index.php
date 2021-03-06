<!-- Chat Room
            ================================================= -->
<div class="chat-room">
    <div class="row">
        <div class="col-md-12">
            <!-- Contact List in Left-->
            <ul class=" nav nav-tabs contact-list">
                <?php foreach ($notification as $pst): ?>
                <li class="active" style="height: 100px;">
                    <?php if ($pst->notif == 'Mulai Mengikuti Anda.'): ?>
                    <a href="<?=base_url('friend/visitProfile/') . $pst->id;?>">
                        <?php else: ?>
                        <a href="<?=base_url('user/getIdposting/') . $pst->id_posting;?>">
                            <?php endif;?>
                            <div class="contact">
                                <img src="<?=base_url('assets_user/');?>images/<?=$pst->image;?>" alt=""
                                    class="profile-photo-sm pull-left" />
                                <div class="msg-preview">
                                    <h6><?=$pst->name;?></h6>

                                    <p class="text-muted"><?=$pst->notif;?></p>

                                    <small class="text-muted"></small>
                                </div>
                            </div>
                        </a>
                        <?php endforeach;?>
                </li>

                <!--Contact List in Left End-->
        </div>
        <!--Chat Messages in Right End-->
    </div>
</div>

</div>