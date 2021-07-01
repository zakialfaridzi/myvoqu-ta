<!-- Newsfeed Common Side Bar Right
          ================================================= -->

<div class="col-md-2" style="margin-top: 10px;position: sticky;">
    <div class="suggestions" id="sticky-sidebar">

        <h5 class="grey">Mungkin anda kenal ?</h5>
        <?php foreach ($suggestion as $ou) : ?>
            <div class="follow-user">
                <img src="<?= base_url('assets_user/images/' . $ou->image); ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                    <h5> <?php if ($ou->id == $this->session->userdata('id')) : ?>
                            <a href="<?= base_url('profile') ?>"><?= $ou->name; ?></a>
                        <?php else : ?>
                            <a href="<?= base_url('friend/visitProfile/') . $ou->id; ?>"><?= $ou->name; ?></a>
                        <?php endif; ?>
                    </h5>
                    <form method="post" action="<?= base_url('user/addFollow') . "/" . $this->uri->segment('3'); ?>">
                        <input type="hidden" name="id_usertarget" value="<?= $ou->id; ?>">
                        <input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
                        <input type="hidden" name="nama" value="<?= $ou->name; ?>">
                        <input type="hidden" name="bio" value="<?= $ou->bio; ?>">
                        <input type="hidden" name="image" value="<?= $ou->image; ?>">
                        <button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ikuti</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>

        <hr>

        <h5 class="grey">Pengumuman</h5>
        <?php foreach ($pengumuman as $pgu) : ?>
            <div class="alert alert-info alert-dismissible show" role="alert">

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
                <p><?= $pgu->isi_pengumuman ?></p>

            </div>
        <?php endforeach; ?>


        <h5 class="grey">Materi dari Admin</h5>

        <?php foreach ($postgen as $pst) : ?>
            <div class="follow-user">

                <a href="<?= base_url() . 'User/getIdpostgen/' . $pst->id_posting; ?>"><?= $pst->html; ?></a>

                <!-- <video class="post-video" controls width="500" height="500">
                <source src="base_url('assets_user/file_upload/' . $pst->fileName)?>" type=" video/mp4">
            </video>

            <img src="base_url('assets_user/images/' . $ou->image);?>" alt="" class='post-image'/> -->

                <!-- <div class="video-wrapper"><video class="post-video" controls width="500" height="500">
                    <source src=http://localhost/myvoqu/assets_user/file_upload/60753efdcecbb.mp4 type="video/mp4">
                </video></div> -->
                <!-- <img src=http://localhost/myvoqu/assets_user/file_upload/6075429d3ef62.png alt="post-image"
                class="img-responsive post-image" width="100" /> -->

                <!-- <div class="video-wrapper"><video class="post-video" controls width="500" height="500"><source src= http://localhost/myvoqu/assets_user/file_upload/60767409abca0.mp4 type="video/mp4"></video></div> -->
            </div>
        <?php endforeach; ?>


        <!-- <h5 class="grey">Iklan <i class="fas fa-ad"></i></h5>
            <div class="follow-user">
                <video class="post-video" controls width="500" height="500">
                    <source src="base_url('assets_user/iklan/iklan_myvoqu.mp4')?>" type=" video/mp4">
                </video> -->

        <!-- <div class="video-wrapper"><video class="post-video" controls width="500" height="500">
                    <source src=http://localhost/myvoqu/assets_user/file_upload/60753efdcecbb.mp4 type="video/mp4">
                </video></div> -->
        <!-- <img src=http://localhost/myvoqu/assets_user/file_upload/6075429d3ef62.png alt="post-image"
                class="img-responsive post-image" width="100" /> -->
        <!-- </div> -->

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
<br>



<script src="<?= base_url('assets_user/'); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/jquery.sticky-kit.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/jquery.scrollbar.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/script.js"></script>


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

<style>
    #snackbar {
        visibility: hidden;
        min-width: 400px;
        margin-left: -195px;
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




</body>

<!-- Mi
rrored from mythemestore.com/friend-finder/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jan 2020 16:01:50 GMT -->




<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script type="text/javascript">
    var rupiah = document.getElementById('nominal');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="<?= base_url('assets_user/') ?>js/select2.min.js"></script>
<script>
    function getCommentMateri(idmp) {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('Library/getKomen/') ?>" + idmp,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                for (let i = 0; i < data.length; i++) {
                    const id_materi = idmp;
                    const image = '<?= base_url('assets_user/images/') ?>' + data[i].image;
                    const id_user = data[i].id_user;
                    const url_user = '<?= base_url('Friend/visitProfile/') ?>' + id_user;
                    const nama_user = data[i].name;
                    const comment = data[i].comment;
                    const idkomen = data[i].id_m_comment;
                    if (id_user == <?= $this->session->userdata('id'); ?>) {
                        var theKomen = `<div class="post-comment"><img src="${image}" alt="" class="profile-photo-sm" />
                                        <p>
                                            <a href="${url_user}" class="profile-link">${nama_user}</a>
                                            <p>
                                            &nbsp;
                                            ${comment}
                                            </p>
                                            &emsp13;
                                        </p>
                                        <a href="#" style="color: red; text-decoration: none; margin-right: 0px;" onclick="hapuskomen(${idkomen},${id_materi})" data-idkomen=${idkomen} class="pull-right">hapus</a>
                                        </div>`;
                        $('#list-comment'+idmp).append(theKomen);
                    } else {
                        var theKomen = `<div class="post-comment"><img src="${image}" alt="" class="profile-photo-sm" />
                                        <p>
                                            <a href="${url_user}" class="profile-link">${nama_user}</a>
                                            <p>
                                            &nbsp;
                                            ${comment}
                                            </p>
                                            &emsp13;
                                        </p></div>`;
                        $('#list-comment'+idmp).append(theKomen);
                    }
                }
            }
        });
    }

    function hapuskomen(idmk, idmp) {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Library/deleteComment') ?>",
            data: {
                id_komen: idmk
            },
            success: function(response) {
                $('#list-comment'+idmp).html('');
                getCommentMateri(idmp);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    $('#tutup-modal').on('click', function() {
        idmp = $('#tutup-modal').data('idmp');
        $('#list-comment'+idmp).html('');
    });

    function addCommentMateri(idmp) {
        var comment = $('#input-comment'+idmp).val();
        if (comment == null || comment == ' ') {
            //send error
            console.log('inputan kosong show error');
        } else {
            console.log('inputan masuk post');
            $.ajax({
                type: 'POST',
                url: "<?= base_url('Library/postComment') ?>",
                data: {
                    id_materi: idmp,
                    id_user: '<?= $this->session->userdata('id') ?>',
                    comment: comment,
                },
                success: function(response) {
                    $('#input-comment'+idmp).val('');
                    $('#list-comment'+idmp).html('');
                    getCommentMateri(idmp);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }




    $(document).ready(function() {
        $("#nama_surah").on("input", function() {
            // console.log('inputan');
            $.ajax({
                type: 'GET',
                url: "<?= base_url('assets_user/') ?>json/quran.json",
                data: {
                    "criteria": $("#nama_surah").val()
                },
                success: function(data) {
                    console.log(data);
                    $("#list-surah").empty();
                    for (var i = 0; i < data.chapters.length; i++) {
                        // $("#list-surah").append("<option value=" +data.chapters[i].name_simple + " data-ayat=" + data.chapters[i].verses_count + " data-suratke="+ data.chapters[i].id +" data-arti="+ data.chapters[i].translated_name.name +"></option>");
                        $("#list-surah").append(`<option value=" ${data.chapters[i].name_simple} " data-ayat=" ${data.chapters[i].verses_count} " data-suratke="${data.chapters[i].id}" data-arti="${data.chapters[i].translated_name.name}"></option>`);
                    }
                }
            })
            var ayat = $("#list-surah option[value='" + $('#nama_surah').val() + "']").attr('data-ayat');
            var arti = $("#list-surah option[value='" + $('#nama_surah').val() + "']").attr('data-arti');
            var suratke = $("#list-surah option[value='" + $('#nama_surah').val() + "']").attr('data-suratke');
            $('#arti').val(arti);
            $('#ayat').val(ayat);
            $('#suratke').val(suratke);
        });
    });
    $('#list-ayat').on('change', function() {
        $('#list-ayat2').find('option').remove().end().append('<option disabled selected>Pilih Ayat ke 2</option>');
        var ayat = $('select[name=fromAyat] option').filter(':selected').val();
        var options = $("#list-ayat2");
        var ayatSurah = $('#list-ayat').data('ayat');
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
</script>






</html>