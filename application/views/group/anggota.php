<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <?= $this->session->flashdata('msg'); ?>
            <div>
                <div class="chat-room">
                    <div class="row">
                    <a href="<?= base_url(); ?>group/ingroup/<?= $this->uri->segment('3'); ?>" style="text-decoration:none; float: left;">
                        <h4><span class="label label-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</span></h4>
                    </a>
                    <br>
                        <h3> Anggota Group</h3>
                        <div class="col-md-12">
                            <?php if ($user['role_id'] == 3) { ?>
                                <?php foreach ($datagroup as $id) : ?>
                                    <a href="<?= base_url('group/tambahAnggota') . "/" . $id['id']; ?>" class="btn btn-success" style="float: right; 
                            margin-right: 10px;">Tambah Anggota +</a>
                                <?php endforeach; ?>
                            <?php } ?>
                            <!-- Contact List in Left-->
                            <ul class=" nav nav-tabs contact-list" style="margin-top: 50px">
                                <?php 
                                if (empty($anggota)) {
                                    echo '<center>Tidak mempunyai anggota</center>';
                                }else{
                                    foreach ($anggota as $penghuni) { 
                                ?>
                                    <li class="active" style="height: auto;">
                                        <div class="contact">
                                            <img src="<?= base_url('assets_user/images/').$penghuni['image'] ?>" alt="" class="profile-photo-sm pull-left" />
                                            <div class="msg-preview" style="margin-left: 50px">
                                                <form method="POST" action="<?= base_url('group/kickUser') . "/" . $this->uri->segment('3'); ?>">
                                                    <input type="hidden" name="iduser" value="<?= $penghuni['id_anggota'] ?>" ?>
                                                    <h6><?= $penghuni['name']; ?></h6>
                                                    <?php if ($user['role_id'] == 3) { ?>
                                                        <button type="submit" class="btn btn-danger btn-sm" style="float: right; margin-top: -15px;">Remove from group</button>
                                                    <?php } ?>
                                                    <p class="text-muted"><?= $penghuni['bio']; ?></p>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                    <?php } } 
                                    ?>
                            </ul>
                            <!--Contact List in Left End-->
                        </div>
                        <!--Chat Messages in Right End-->
                    </div>
                </div>

            </div>


        </div>