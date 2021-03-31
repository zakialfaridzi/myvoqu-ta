<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Forget your password? :(</h3>
            <p>To reset your password, enter the email address you use to reset your old password</p>
            <?= $this->session->flashdata('message'); ?>
            <form method="post" action="<?= base_url('auth/forgotPassword') ?>">

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-button full-width">
                    <button type="submit" class="ibtn btn-success">Send Reset Link</button>
                </div>

            </form>

            <a class="text-light" href="<?= base_url('auth') ?>">Back</a>

        </div>

    </div>
</div>
</div>
</div>