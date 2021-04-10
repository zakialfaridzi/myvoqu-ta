<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Silahkan Login Dengan Akun Yang Sudah Aktif.</h3>
            <p>Selamat Datang di Website MyVoQu.</p>
            <div class="page-links">
                <a href="login5.html" class="active">Login</a><a
                    href="<?=base_url('auth/registration');?>">Registrasi</a>
            </div>
            <?=$this->session->flashdata('message');?>

            <form method="post" action="<?=base_url('auth')?>">


                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email"
                        placeholder="Masukkan Email..." value="<?=set_value('email');?>">
                    <?=form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>


                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password"
                        name="password">
                    <?=form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                </div>



                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Login</button> <a
                        href="<?=base_url('auth/forgotPassword');?>">Lupa Password?</a>
                </div>
            </form>


        </div>
    </div>
</div>
</div>
</div>