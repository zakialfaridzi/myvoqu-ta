<?php foreach ($type as $au): ?>
<div class="col-md-6 col-sm-6">
    <div class="friend-card">
        <img src="<?=base_url('assets_user/');?>images/covers/default_group_cover.jpg" alt="profile-cover"
            class="img-responsive cover" />
        <div class="card-info">
            <img src="<?=base_url('assets_user/')?>images/<?=$au->image;?>" alt="user" class="profile-photo-lg" />



            <div class="friend-info">


                <div style="margin-top: 0px;">

                    <h5><a href="<?=base_url('friend/visitProfile/') . $au->id;?>"><?=$au->name;?></a></h5>
                    <p><?=$au->bio;?></p>
                </div>

            </div>
        </div>

    </div>
</div>
<?php endforeach;?>
