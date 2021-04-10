<div id="page-contents">
    <div class="row">
        <div class="col-md-3">

            <!--Edit Profile Menu-->
            <ul class="edit-menu">
                <li class="<?=$on_p;?>"><i class="fas fa-photo" style="color: green;"></i><a
                        href="<?=base_url('profile/editPhoto');?>">Perbarui Foto</a>
                </li>

                <li class="<?=$on_f;?>"><i class="fas fa-info" style="color: green;"></i><a
                        href="<?=base_url('profile/editProfile')?>">Informasi Akun</a></li>

                <li class="<?=$on_s;?>"><i class="fas fa-user-lock" style="color: red;"></i><a
                        href="<?=base_url('profile/editPassword');?>">Ubah Password</a>
                </li>


            </ul>

        </div>