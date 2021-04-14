<!-- Post Content

================================================= -->


<?=$this->session->flashdata('mm');?>




<?php foreach ($postgendetail as $pst): ?>

    <div class="post-content">

        <input type="hidden" value="<?=$pst->id_posting;?>" id="id_post">


        <?=$pst->html;?>



        <div class="post-container">
            <img src="<?=base_url('assets/');?>foto/<?=$pst->image;?>" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
                <div class="user-info">
                    <h5>
                    <h5>
                    <?php if ($pst->id == $this->session->userdata('id')): ?>
							<?=$pst->name;?>&emsp;<span class="badge badge-pill badge-danger">Admin</span>
						<?php else: ?>
							<?=$pst->name;?>&emsp;<span class="badge badge-pill badge-danger">Admin</span>
						<?php endif;?>
					</h5>
                    <p class="text-muted">Diunggah pada <?=date('d F Y ', $pst->date_post);?></p>
                </div>


                <div class="line-divider"></div>
                <div class="post-text">
                    <p><?=$pst->caption;?> </p>
                </div>
                <div class="line-divider"></div>
                <?=$this->session->flashdata('nn');?>
        </div>
    </div>
    </div>

<?php endforeach;?>
<!-- Post Content=================================================-->



</div>
