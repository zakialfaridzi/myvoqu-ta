<!--Header End-->

<div id="page-contents">
    <div class="container">
        <div class="row">

            <!-- Newsfeed Common Side Bar Left
          ================================================= -->
            <?php foreach ($allUser as $us): ?>
            <div class="col-md-3 static">

                <div class="profile-card">
                    <img src="<?=base_url('assets_user/images/' . $us->image);?> " alt="user" class="profile-photo" />
                    <h5><a href="<?=base_url('profile')?>" class="text-white"><?=$us->name;?></a>
                        <?php if ($us->role_id == 3) {?>
                        <span class="badge badge-secondary">Mentor</span>
                        <?php }?>
                    </h5>
                    <?php foreach ($jumlahfollowers as $jf): ?>
                    <a href="<?=base_url('profile/followers');?>" class="text-white"><i
                            class="ion ion-android-person-add"></i><?=$jf->jumlahfollowers;?>
                        Pengikut</a>
                    <?php endforeach;?>
                </div>
                <!--profile card ends-->
                <div>
                    <ul class="nav-news-feed">

                        <li><i class="far fa-bell" style="color: tomato;"></i>
                            <div><a href="<?=base_url('notifikasi')?>">Notifikasi</a></div>
                        </li>

                        <li><i class="fas fa-book-reader" style="color: burlywood;"></i>
                            <div><a href="<?=base_url('library')?>">Material Pembelajaran</a></div>
                        </li>

                        <li><i class="fas fa-search" style="color: peachpuff;"></i>
                            <div><a href="<?=base_url('friend')?>">Temukan Teman</a></div>
                        </li>

                        <li><i class="fas fa-users" style="color: royalblue;"></i>
                            <div><a href="<?=base_url('group')?>">Grup</a></div>
                        </li>

                        <li><i class="fas fa-comments" style="color: yellowgreen;"></i>
                            <div><a href="<?=base_url('chat/index');?>">Pesan</a></div>
                        </li>

                        <li><i class="fas fa-comment-dots" style="color: black;"></i>
                            <div><a href="<?=base_url('Chatall/');?>">Ngobrol Dengan Semua Pengguna</a>
                            </div>
                        </li>

                        <li><i class="fa fa-video text-muted" style="color: black;"></i>
                            <div><a href="<?=base_url('Colab/');?>">Kolaborasi</a></div>
                        </li>

                    </ul>
                    <!--news-feed links ends-->
                    <div id="container1">
                        <div id="chat-block">
                            <div class="title">Pengguna Online</div>
                            <ul class="online-users list-inline">
                                <?php foreach ($otherUser as $ou):
    if ($ou->role_id != 1) {?>
                                <li>
                                    <a href="newsfeed-messages.html" title="<?=$ou->name;?>"><img
                                            src="<?=base_url('assets_user/images/' . $ou->image);?>" alt="user"
                                            class="img-responsive profile-photo" /><span class="<?=$ou->status;?>"
                                            id="keyword"></span>
                                    </a>
                                </li>
                                <?php }
endforeach;?>

                            </ul>
                        </div>
                    </div>
                </div>
                <!--chat block ends-->
            </div>
            <div class="col-md-7">



                <div id="fp"></div>

                <!-- <div class="alert alert-success alert-dismissible show" role="alert">
                    Kamu memilih foto/video <strong>papa.jpg</strong> ya!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->

                <!-- Post Create Box
            ================================================= -->
                <div class="create-post">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="form-group">
                                <img src="<?=base_url('assets_user/images/' . $us->image);?>" alt=""
                                    class="profile-photo-md" />
                                <?php if ($this->uri->segment('2') == 'materi' && $this->session->userdata('role_id') == 3) {?>
                                <h4>Buat Materi</h4><br>
                                <form action="<?=base_url('library/posting/') . $this->uri->segment('3');?>"
                                    method="post" enctype="multipart/form-data">
                                    <textarea cols="30" rows="1" class="form-control" placeholder="Ayat" name="ayat"
                                        id="caption"></textarea>
                                    <?=form_error('caption', '<small class="text-danger pl-3">', '</small>');?>
                                    <?php } else {?>
                                    <form action="<?=base_url('user/posting');?>" method="post"
                                        enctype="multipart/form-data">
                                        <textarea cols="30" rows="1" class="form-control"
                                            placeholder="Masukkan kata-kata" name="caption" id="caption"></textarea>
                                        <?=form_error('caption', '<small class="text-danger pl-3">', '</small>');?>
                                        <?php }?>
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-5">

                            <div class="tools">
                                <ul class="publishing-tools list-inline">
                                    <li class="nav-item">
                                        <label for="file-input-gambar">
                                            <a class="nav-link"><i class="fas fa-photo-video"></i></a>
                                        </label>
                                        <input type="file" id="file-input-gambar" style="display: none;" name="file"
                                            multiple onchange="GetFileSizeNameAndType()">
                                    </li>
                                </ul>
                                <button class="btn btn-primary pull-right"
                                    style="background-color:#6fb8df;">Unggah</button>
                                <input type="hidden" value="<?=$this->session->userdata('id');?>" name="id_user"
                                    id="id_user">
                                <?php foreach ($idpost as $idpst): ?>
                                <input type="hidden" value="<?=$idpst->id_posting;?>" name="id_posting">
                                <?php endforeach;?>
                                </form>
                            </div>
                            <?php endforeach;?>
                        </div>

                    </div>
                </div><!-- Post Create Box End-->

                <?=$this->session->flashdata('message');?>

                <script type="text/javascript">
                function GetFileSizeNameAndType() {
                    var fi = document.getElementById('file-input-gambar'); // GET THE FILE INPUT AS VARIABLE.

                    var totalFileSize = 0;

                    // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
                    if (fi.files.length > 0) {
                        // RUN A LOOP TO CHECK EACH SELECTED FILE.
                        for (var i = 0; i <= fi.files.length - 1; i++) {
                            //ACCESS THE SIZE PROPERTY OF THE ITEM OBJECT IN FILES COLLECTION. IN THIS WAY ALSO GET OTHER PROPERTIES LIKE FILENAME AND FILETYPE
                            var fsize = fi.files.item(i).size;
                            totalFileSize = totalFileSize + fsize;
                            document.getElementById('fp').innerHTML =
                                document.getElementById('fp').innerHTML +
                                '<div class="alert alert-success alert-dismissible show" role="alert"> Kamu memilih foto/video <strong>' +
                                fi.files.
                            item(i).name + '</strong > ' +
                                'ya!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>'
                        }
                    }
                }
                </script>

                <!-- Kamu memilih foto/video <strong>papa.jpg<
/strong> ya! -->
                <div class="alert alert-success alert-dismissible show" role="alert">

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading">Saldo VOQU-Wallet</h4>
                    <p>Saldo dana kamu sekarang adalah
                        <strong>Rp<?=number_format($saldo_dompet['saldo'], 2, ',', '.')?></strong>
                        <i class="fas fa-wallet"></i>
                    </p>
                    <p>
                        <a class="btn btn-success" data-toggle="modal" data-target="#tambahDana"><i
                                class="fas fa-plus"></i> Top Up</a>

                        <a class="btn btn-warning" href="<?=base_url('transaksi/')?>"><i class="fas fa-history"></i>
                            Riwayat</a>
                        <!-- <a class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="<?=$au->id?>"
                            id="showInfaqModal">Infaq</a> -->
                    </p>

                </div>

                <?=$this->session->flashdata('alert')?>




                <!-- Modal -->
                <div class="modal fade" id="tambahDana" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Top up VOQU-Wallet <i class="fas fa-wallet"></i></h4>
                            </div>
                            <div class="modal-body" id="modal_view">

                                <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
                                    <input type="hidden" name="result_type" id="result-type" value="">

                                    <input type="hidden" name="result_data" id="result-data" value="">



                                    <div class="alert alert-warning alert-dismissible show" role="alert">
                                        Minimal pengisian wallet adalah <strong>Rp10.0000,00</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nominal Pengisian</label>
                                        <input type="text" class="form-control" placeholder="Masukan Nominal Pengisian"
                                            name="nominal_topup" id="nominal" required
                                            message="minimal top up adalah Rp10.000,00">
                                        <small style="color: red;display:none" id="errorMsg"><i>*minimal top up adalah
                                                Rp10.000,00</i></small>

                                    </div>







                                    <input type="hidden" name="redirect" value="<?=$this->uri->segment(1)?>">



                                    <input type="hidden" name="email" value="<?=$this->session->userdata('email')?>"
                                        id="email">



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                <button class="btn btn-info" id="pay-button" style="display: none;">Bayar</button>
                            </div>
                            </form>


                        </div>



                    </div>
                </div>

                <script>
                $("#nominal").keyup(function() {



                    var rupiah = $('#nominal').val();
                    var clean = rupiah.replace(/\D/g, '');

                    if (clean < 10000) {
                        $('#errorMsg').show();
                        $('#pay-button').hide();
                    } else {
                        $('#errorMsg').hide();
                        $('#pay-button').show();
                    }
                });
                </script>

                <script type="text/javascript">
                $('#pay-button').click(function(event) {
                    // alert('clicked')

                    event.preventDefault();
                    $(this).attr("disabled", "disabled");
                    var nominal = $("#nominal").val();
                    var email = $("#email").val();
                    $.ajax({
                        type: 'POST',
                        url: '<?=site_url()?>/snap/token',
                        data: {
                            nominal: nominal,
                            email: email,
                        },
                        cache: false,

                        success: function(data) {
                            //location = data;

                            console.log('token = ' + data);

                            var resultType = document.getElementById('result-type');
                            var resultData = document.getElementById('result-data');

                            function changeResult(type, data) {
                                $("#result-type").val(type);
                                $("#result-data").val(JSON.stringify(data));
                                //resultType.innerHTML = type;
                                //resultData.innerHTML = JSON.stringify(data);
                            }

                            snap.pay(data, {

                                onSuccess: function(result) {
                                    changeResult('success', result);
                                    console.log(result.status_message);
                                    console.log(result);
                                    $("#payment-form").submit();
                                },
                                onPending: function(result) {
                                    changeResult('pending', result);
                                    console.log(result.status_message);
                                    $("#payment-form").submit();
                                },
                                onError: function(result) {
                                    changeResult('error', result);
                                    console.log(result.status_message);
                                    $("#payment-form").submit();
                                }
                            });
                        }
                    });
                });
                </script>