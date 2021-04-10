<?php foreach ($type as $au): ?>
<div class="col-md-6 col-sm-6">
    <div class="friend-card">
        <img src="<?=base_url('assets_user/');?>images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
        <div class="card-info">
            <img src="<?=base_url('assets/')?>img/profile/<?=$au->image;?>" alt="user" class="profile-photo-lg" />
            <div class="friend-info">
                <a href="#" class="btn btn-success" style="margin-left: 80%; margin-top: 10px;">Follow</a>
                <div style="margin-top: -40px;">
                    <h5><a href="timeline.html" class="profile-link"><?=$au->name;?></a></h5>
                    <p>Student at Harvard</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
