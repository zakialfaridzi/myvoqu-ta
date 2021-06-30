<div class="col-md-7">

    <!-- Change Password
================================================= -->
    <div class="edit-profile-container">
        <div class="block-title">
            <h4 class="grey"><i class="icon ion-ios-locked-outline"></i>Change Password</h4>
            <div class="line"></div>

        </div>
        <div class="edit-block">

            <?=$this->session->flashdata('message')?>



            <form name="update-pass" id="education" class="form-inline" method="post"
                action="<?=base_url('Profile/editPassword')?>">

                <div class="row">
                    <div class="form-group col-xs-6">
                        <label>Password Baru</label>
                        <input class="form-control input-group-lg" type="password" name="password1"
                            title="Masukkan password" placeholder="New password" />
                        <?=form_error('password1', '<small class="text-danger pl-3">', '</small>');?>
                    </div>



                    <div class="form-group col-xs-6">
                        <label>Konfirmasi Password</label>
                        <input class="form-control input-group-lg" type="password" name="password2"
                            title="Masukkan password" placeholder="Konfirmasi password" />

                        <?=form_error('password2', '<small class="text-danger pl-3">', '</small>');?>

                    </div>

                </div>

                <button class="btn btn-primary">Ubah Password</button>
            </form>
        </div>
    </div>
</div>
