<?php if ($this->uri->segment(1) == "friend"): ?>

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

<?php else: ?>

<?php foreach ($type as $au): ?>

<div class="col-md-6 col-sm-6">
    <div class="friend-card">
        <img src="<?=base_url('assets_user/');?>images/covers/default_group_cover.jpg" alt="profile-cover"
            class="img-responsive cover" />
        <div class="card-info">
            <img src="<?=base_url('assets_user/')?>images/<?=$au->image;?>" alt="user" class="profile-photo-lg" />

            <?php if (is_null($au->avg_rating)): ?>

            <a class="badge" style="background-color: darkorange;">mentor baru</a>

            <?php else: ?>

            <a class="badge" style="background-color: darkorange;"><?=$au->avg_rating?> <i class="fas fa-star"></i></a>

            <?php endif;?>

            <a class="badge" style="background-color: deepskyblue;">Mentor</a>


            <div class="friend-info">



                <h5><a href="<?=base_url('friend/visitProfile/') . $au->id;?>"><?=$au->name;?></a></h5>
                <p>Mentor MyVoQu</p>


            </div>
            <a class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="<?=$au->id?>"
                id="showInfaqModal">Infaq</a>

            <button type=" button" class="btn btn-success">
                Testimoni <i class="fas fa-quote-right"></i></button>

        </div>

    </div>
</div>

<?php endforeach;?>




<?php endif?>