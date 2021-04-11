<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Ubah Password</h3>
            <p>Masukkan password baru anda.</p>
            <?=$this->session->flashdata('message');?>
            <form method="post" action="<?=base_url('auth/changePassword')?>">

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1"
                        placeholder="Enter Password Baru...">
                    <?=form_error('password1', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2"
                        placeholder="Ulangi Password">
                    <?=form_error('password2', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-button full-width">
                    <button type="submit" class="ibtn btn-success">Ubah Password</button>
                </div>

            </form>

        </div>

    </div>
</div>
</div>
</div>