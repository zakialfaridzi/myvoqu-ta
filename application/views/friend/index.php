<div class="friend-list">
    <div class="row">


        <div id="container">
            <?php foreach ($otherUser as $au): ?>
            <div class="col-md-6 col-sm-6">
                <div class="friend-card">
                    <img src="<?=base_url('assets_user/');?>images/covers/default_group_cover.jpg" alt="profile-cover"
                        class="img-responsive cover" />
                    <div class="card-info">
                        <img src="<?=base_url('assets_user/')?>images/<?=$au->image;?>" alt="user"
                            class="profile-photo-lg" />



                        <div class="friend-info">


                            <div style="margin-top: 0px;">

                                <h5><a href="<?=base_url('friend/visitProfile/') . $au->id;?>"><?php if($au->role_id == 3) : ?>
                                <h3 style="color: #6fb8df;"><?= $au->name; ?> <a class="badge" style="background-color: deepskyblue;">Mentor</a></h3>
                                <?php else : ?>
                                <h3 style="color: #6fb8df;"><?= $au->name; ?></h3>
                                <?php endif ?></a></h5>
                                
                                <p><?=$au->bio;?></p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach;?>
        </div>









    </div>
</div>
</div>


<script src="<?=base_url('assets_user/js/search.js');?>"></script>

<!-- <div id="snackbar" class="show">

    <button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
        <span aria-hidden="true" onclick="myFunction()">&times;</span>
    </button>


    <p>Sudah kah kamu infaq hari ini?<br>
        jika belum, <a href="<?=base_url('infaq')?>" class="text-red">klik disini</a> untuk infaq</p>


</div> -->