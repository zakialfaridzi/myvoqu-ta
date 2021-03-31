<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Dont have an account ?</h3>
            <p>Register to be our team. Or you want to be <a href="<?=base_url('auth/registMentor');?>"
                    style="color:blue;">Mentor</a> ?</p>
            <div class="page-links">
                <a href="<?=base_url('auth');?>">Login</a>
                <a href="<?=base_url('auth/registration')?>" class="active">Register</a>
            </div>
            <form method="post" action="<?=base_url('auth/registration');?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="name" placeholder="Full Name"
                        name="name" value="<?=set_value('name');?>" autocomplete="off">
                    <?=form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-group">

                    <select class="custom-select" id="gender" name="gender">
                        <option selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <?=form_error('gender', '<small class="text-danger pl-3">', '</small>');?>

                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email"
                        placeholder="Email Address" value="<?=set_value('email');?>">
                    <?=form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1"
                        placeholder="Password">

                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2"
                        placeholder="Repeat Password">
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