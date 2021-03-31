<div class="row mt-3">
    <?php if ($user['role_id'] == 3) { ?>
        <div class="col-md-3" style="float: right;">
            <a href="<?= base_url(); ?>group/tambahGroup" class="btn btn-success">Create Group +</a>
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
            <d class="card" style="width: 18rem;">
                <img src="<?= base_url().'assets/img/group/'.$group['image'] ?>" class="card-img-top" alt="profile-cover" style="height: 160px; width: 180px;">
                <div class="card-body">
                    <div class="friend-info">
                        <h5><a href="<?= base_url(); ?>group/inGroup/<?= $group['id']; ?>" class="profile-link"><?= $group['nama']; ?></a></h5>
                        <p><?= $group['deskripsi']; ?></p>
                    </div>
                </div>
        </div>
    <?php } endforeach; ?>
</div>
<?php } elseif ($this->session->userdata['role_id'] == 2) { ?>
    <div class="row">
    <?php foreach ($detgroup as $ugroup) : ?>
        <div class="col-md-4 col-sm-6" style="float: left;">
            <d class="card" style="width: 18rem;">
                <img src="<?= base_url().'assets/img/group/'.$ugroup['image'] ?>" class="card-img-top" alt="profile-cover" style="height: 160px; width: 180px;">
                <div class="card-body">
                    <div class="friend-info">
                        <h5><a href="<?= base_url(); ?>group/inGroup/<?= $ugroup['id_group']; ?>" class="profile-link"><?= $ugroup['nama']; ?></a></h5>
                        <p><?= $ugroup['deskripsi']; ?></p>
                    </div>
                </div>
        </div>
    <?php endforeach; ?>
</div>
<?php } ?>

</div>