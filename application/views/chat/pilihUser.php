<!-- Chat Room
            ================================================= -->
<div class="chat-room"style="height: 100px;">
    <b>Semua Teman Yang Diikuti</b>

    <a href="<?= base_url('chat/index'); ?>" style='float:right; color:white; background-color: #6FB8DF; border:none; border-radius: 10px;'><b>&nbsp; Semua Pesan Yang Diterima&nbsp;</b></a>
    <div class="row" >
        <div class="col-md-12">

            <!-- Contact List in Left-->

            <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">

            <?php foreach ($getChat as $pst) : ?>
                    <?php if ($pst->id_usertarget != $this->session->userdata('id')) : ?>
                        <li class="active" style="height: 100px;">
                            <a href="<?= base_url('chat/chat2/') . $pst->id_usertarget; ?>">
                                <div class="contact">
                                    <img src="<?= base_url('assets_user/') ?>images/<?= $pst->imagetarget; ?>" alt="" class="profile-photo-sm pull-left" />
                                    <div class="msg-preview">
                                        <h6><?= $pst->namatarget; ?></h6>


                                        <p class="text-muted">klik untuk chat</p>
                                        <small class="text-muted"></small>

                                    </div>


                                </div>
                            </a>
                        </li>
                    <?php else : ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <!--Contact List in Left End-->
        </div>
        <!--Chat Messages in Right End-->
    </div>
</div>
</div>