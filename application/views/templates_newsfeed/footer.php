<div class="col-md-2" style="position: fixed;margin-left: 900px;">
    <div class="suggestions" id="sticky-sidebar">
        <h4 class="grey">Mungkin anda kenal ? </h4>
        <?php foreach ($suggestion as $ou): ?>
        <div class="follow-user">

            <img src="<?=base_url('assets_user/images/' . $ou->image);?>" alt="" class="profile-photo-sm pull-left" />
            <div>
                <h5> <?php if ($ou->id == $this->session->userdata('id')): ?>
                    <a href="<?=base_url('profile')?>"><?=$ou->name;?></a>
                    <?php else: ?>
                    <a href="<?=base_url('friend/visitProfile/') . $ou->id;?>"><?=$ou->name;?></a>
                    <?php endif;?>
                </h5>
                <form method="post" action="<?=base_url('user/addFollow') . "/" . $this->uri->segment('3');?>">
                    <input type="hidden" name="id_usertarget" value="<?=$ou->id;?>">
                    <input type="hidden" name="id_userfollow" value="<?=$this->session->userdata('id');?>">
                    <input type="hidden" name="nama" value="<?=$ou->name;?>">
                    <input type="hidden" name="bio" value="<?=$ou->bio;?>">
                    <input type="hidden" name="image" value="<?=$ou->image;?>">
                    <button class="btn btn-primary"
                        style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ikuti</button>
                </form>
            </div>
        </div>
        <?php endforeach;?>

        <div class="">
            <div class="row-5">
                <div class="footer-wrapper">
                    <div class="">
                        <a href="#"><img src="<?=base_url('assets_login/');?>images/mvqq2.png" alt=""
                                style="width: 200px; margin-bottom: 15px;" /></a>
                        <ul class="list-inline social-icons" style="margin-left: 20p">
                            <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/myvoqu.id/" target="#"><i
                                        class="icon ion-social-instagram"></i></a></li>


                        </ul>




                    </div>




                    <div style="width: 900px;margin-top: 50px;">
                        <div class="card" style="padding: 10px;">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-8">

                                        <h4 class="card-title" style="color: black;">Nominal Dana Akun </h4>
                                        <h3 class="card-text">Rp500.000,00</h3>
                                        <button href="#" class="btn btn-info" style="margin-top: 10px;"><i
                                                class="fas fa-plus"></i></button>


                                    </div>


                                    <div class="col-sm-4" style="margin-top: 35px;">
                                        <div style="font-size: 80px;color: #5badff;">
                                            <i class="fas fa-wallet fa-xs"></i>
                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>



                </div>
            </div>






        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
</div>

<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 40%;
    border-radius: 5px;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

img {
    border-radius: 5px 5px 0 0;
}

.container {
    padding: 2px 16px;
}
</style>




<!-- Footer
    ================================================= -->


<!--preloader-->

<div id="spinner-wrapper">


    <div class="spinner"></div>
</div>


<button id="topBtn"> <i class="fas fa-arrow-up" aria-hidden="true"></i></button>

<style>
#snackbar {
    visibility: hidden;
    min-width: 400px;
    margin-left: -125px;
    background-color: #2492ff;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
    border-radius: 30px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {
        bottom: 0;
        opacity: 0;
    }

    to {
        bottom: 30px;
        opacity: 1;
    }
}

@keyframes fadein {
    from {
        bottom: 0;
        opacity: 0;
    }

    to {
        bottom: 30px;
        opacity: 1;
    }
}

@-webkit-keyframes fadeout {
    from {
        bottom: 30px;
        opacity: 1;
    }

    to {
        bottom: 0;
        opacity: 0;
    }
}

@keyframes fadeout {
    from {
        bottom: 30px;
        opacity: 1;
    }

    to {
        bottom: 0;
        opacity: 0;
    }
}
</style>



<script>
function myFunction() {
    var x = document.getElementById("snackbar");
    x.className = "";
    setTimeout(function() {
        x.className = x.className.replace("show", "");
    }, 2000);
}
</script>


<style>
#topBtn {
    display: none;
    position: fixed;
    bottom: 40px;
    right: 40px;
    font-size: 22px;
    width: 50px;
    height: 50px;
    background: #0486FE;
    color: white;
    border: 2px solid #0486FE;
    cursor: pointer;
    border-radius: 30px;
    outline: none;
}
</style>


<!--Buy button-->


<!-- Scripts
    ================================================= -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"> -->
</script>
<script src="<?=base_url('assets_user/');?>js/jquery-3.1.1.min.js"></script>
<script src="<?=base_url('assets_user/');?>js/bootstrap.min.js"></script>
<script src="<?=base_url('assets_user/');?>js/jquery.sticky-kit.min.js"></script>
<script src="<?=base_url('assets_user/');?>js/jquery.scrollbar.min.js"></script>
<script src="<?=base_url('assets_user/');?>js/script.js"></script>




<script type="text/javascript">
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 40) {
            $('#topBtn').fadeIn();
        } else {
            $('#topBtn').fadeOut();
        }
    });

    $("#topBtn").click(function() {
        $('html,body').animate({
            scrollTop: 0
        }, 1500);
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>






</body>

<!-- Mi
rrored from mythemestore.com/friend-finder/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jan 2020 16:01:50 GMT -->






</html>