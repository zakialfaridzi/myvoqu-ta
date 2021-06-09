<div id="page-contents">
    <div class="row">
        <div class="col-md-3">
            <!--Edit Profile Menu-->
            <ul class="edit-menu">
                <li class="#"><i class="fas fa-info" style="color: green;"></i><a href="<?= base_url('Group/ubahGroup')."/".$this->uri->segment('3'); ?>">Informasi umum</a></li>
                <li class="#"><i class="fas fa-image" style="color: blueviolet;"></i><a href="<?= base_url('Group/ubahPhotoGroup')."/".$this->uri->segment('3'); ?>">Foto Profil Grup</a></li>
                <li class="#"><a href="<?= base_url('Group/deleteGroup') . '/' . $this->uri->segment('3'); ?>" style="color: red;"><b>Hapus Grup</b></a></li>
            </ul>
        </div>