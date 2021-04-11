<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Dont have an account ?</h3>
            <p>Register to be our team. Or you want to be <a href="<?=base_url('auth/registration');?>"
                    style="color:blue;">Normal User</a> ?</p>
            <div class="page-links">
                <a href="<?=base_url('auth');?>">Login</a>
                <a href="<?=base_url('auth/registMentor')?>" class="active">Registrasi</a>
            </div>
            <form method="post" action="<?=base_url('auth/registMentor');?>" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="name" placeholder="Nama Lengkap"
                        name="name" value="<?=set_value('name');?>" autocomplete="off">
                    <?=form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-group">

                    <select class="custom-select" id="gender" name="gender">
                        <option selected>Jenis Kelamin</option>
                        <option value="Male">Laki-laki</option>
                        <option value="Female">Perempuan</option>
                    </select>
                    <?=form_error('gender', '<small class="text-danger pl-3">', '</small>');?>

                </div>



                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email"
                        placeholder="Email Address" value="<?=set_value('email');?>">
                    <?=form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="input-group">

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file">
                        <label class="custom-file-label" for="file-input-gambar">Upload Bukti Ustad/Ustadzah</label>
                    </div>
                </div>



                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1"
                        placeholder="Password">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2"
                        placeholder="Ulangi Password">
                    <?=form_error('password2', '<small class="text-danger pl-3">', '</small>');?>
                </div>





                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Register</button>
                </div>
            </form>





        </div>
    </div>
</div>
</div>
</div>