<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Silahkan Login Dengan Akun Yang Sudah Aktif.</h3>
            <p>Selamat Datang di Website MyVoQu.</p>
            <div class="page-links">
                <a href="<?=base_url('auth');?>" class="active">Login</a><a
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

                </div>


                <div class="input-group mb-2 mr-sm-2">

                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password"
                        name="password">
                    <div class="input-group-prepend">
                        <button class="input-group-text" type="button" onclick="myFunction()"><i class="fas fa-eye"
                                id="eye"></i></button>
                    </div>

                </div>
                <?=form_error('password', '<small class="text-danger pl-3">', '</small>');?>

                <!-- <div class="form-group">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="myFunction()">
                    <label class="custom-control-label" for="customCheck1">Tampilkan Password</label>
                </div> -->

                <script>
                var clicks = 0;

                function myFunction() {
                    clicks += 1;
                    var NAME = document.getElementById("eye")

                    if (clicks % 2 == 0) {
                        NAME.className = "fas fa-eye"

                    } else {
                        NAME.className = "fas fa-eye-slash"
                    }

                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }


                };
                </script>




                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn" onclick="hide()">Login</button>

                    <button class="ibtn" type="button" disabled style="display: none;" id="load_login">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>


                    <a href="<?=base_url('auth/forgotPassword');?>">Lupa Password?</a>
                </div>
            </form>

            <script>
            function hide() {
                $('#submit').hide();
                $('#load_login').show();
            }
            </script>



        </div>
    </div>
</div>
</div>

</div>