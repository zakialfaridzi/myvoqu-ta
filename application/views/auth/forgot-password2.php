<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Kamu lupa password? :(</h3>
            <p>Untuk ubah password kamu, masukkan email untuk mengubah password yang baru.</p>
            <?=$this->session->flashdata('message');?>
            <form method="post" action="<?=base_url('auth/forgotPassword')?>">

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email"
                        placeholder="Masukkan Email..." value="<?=set_value('email');?>">
                    <?=form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-button full-width">
                    <button type="submit" class="ibtn btn-success" onclick="hide()" id="submit">Kirim Link </button>

                    <button class="ibtn btn-success" disabled style="display: none;" id="load_forgot">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>
                </div>

            </form>

            <a class="text-light" href="<?=base_url('auth')?>">Kembali</a>

        </div>

    </div>
</div>
</div>
</div>

<script>
function hide() {
    $('#submit').hide();
    $('#load_forgot').show();
}
</script>