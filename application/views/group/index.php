<div class="row mt-3" style="margin-bottom: 1rem;">
    <?php if ($user['role_id'] == 3) { ?>
        <div class="col-md-3" style="float: right;">
            <!-- <a href="<?= base_url(); ?>group/tambahGroup" class="btn btn-success">Create Group +</a> -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Buat Grup Baru</button>
        </div>
    <?php } ?>
</div>
<?php
if ($this->session->userdata['role_id'] == 3) { ?>
    <div class="row">
        <?php foreach ($allgroup as $group) :
            if ($group['owner'] == $this->session->userdata['id']) {
        ?>
                <div class="col-md-4 col-sm-6" style="float: left;">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= base_url() . 'assets/img/group/' . $group['image'] ?>" class="card-img-top" alt="profile-cover" style="height: 160px; width: 180px;">
                        <div class="card-body">
                            <div class="friend-info" style="padding: 1rem;">
                                <h5><a href="<?= base_url(); ?>group/inGroup/<?= $group['id']; ?>" class="profile-link"><?= $group['nama']; ?></a></h5>
                                <p><?= $group['deskripsi']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        endforeach; ?>
    </div>
<?php } elseif ($this->session->userdata['role_id'] == 2) { ?>
    <div class="row">
        <?php foreach ($detgroup as $ugroup) : ?>
            <div class="col-md-4 col-sm-6" style="float: left;">
                <div class="card" style="width: 18rem;">
                    <img src="<?= base_url() . 'assets/img/group/' . $ugroup['image'] ?>" class="card-img-top" alt="profile-cover" style="height: 160px; width: 180px;">
                    <div class="card-body">
                        <div class="friend-info" style="padding: 1rem;">
                            <h5><a href="<?= base_url(); ?>group/inGroup/<?= $ugroup['id_group']; ?>" class="profile-link"><?= $ugroup['nama']; ?></a></h5>
                            <p><?= $ugroup['deskripsi']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php } ?>

</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Buat Group baru</h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('group/tambahGroup') ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                        <label for="nama">Nama Group</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Grup Penghafal 30juz">
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                        <label for="nama">Deskripsi Group</label>
                        <input type="text" name="desc" class="form-control" id="desc" placeholder="Deskripsi Group">
                        <small class="form-text text-danger"><?= form_error('Deskripsi'); ?></small>
                        <input type="text" name="image" id="image" value="default.png" hidden>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
            </form>
        </div>

    </div>
</div>