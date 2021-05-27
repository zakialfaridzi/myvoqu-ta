<?php foreach ($info as $i): ?>



<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">

            <div id="fp"></div>

            <!-- Post Create Box
              ================================================= -->

            <div class="create-post">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="form-group">
                            <img src="<?=base_url('assets_user/')?>images/<?=$i->image;?>" alt=""
                                class="profile-photo-md" />
                            <form action="<?=base_url('profile/posting');?>" method="post"
                                enctype="multipart/form-data">
                                <textarea cols="30" rows="1" class="form-control" placeholder="Masukkan kata-kata"
                                    name="caption" id="caption"></textarea>
                                <?=form_error('caption', '<small class="text-danger pl-3">', '</small>');?>
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
                                style="background-color: #6fb8df;outline: none;">Unggah</button>

                            <input type="hidden" value="<?=$this->session->userdata('id');?>" name="id_user"
                                id="id_user">
                            </form>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post Create Box End-->
            <?=$this->session->flashdata('message');?>


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
                    <a class="btn btn-success" data-toggle="modal" data-target="#tambahDana"><i class="fas fa-plus"></i>
                        Top Up</a>

                    <a class="btn btn-warning" href="<?=base_url('transaksi/')?>"><i class="fas fa-history"></i>
                        Riwayat</a>
                    <!-- <a class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="<?=$au->id?>"
		id="showInfaqModal">Infaq</a> -->
                </p>

            </div>


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



                                <div class="alert alert-info alert-dismissible show" role="alert">
                                    Minimal pengisian wallet adalah <strong>Rp10.0000,00</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nominal Pengisian</label>
                                    <input type="number" class="form-control" placeholder="Masukan Nominal Pengisian"
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









            <!-- Post Content
              ================================================= -->

            <?=$this->session->flashdata('mm');?>



            <?php foreach ($posting as $pst): ?>



            <div class="post-content">

                <div class="post-date hidden-xs hidden-sm">
                    <h5></h5>

                </div>

                <input type="hidden" value="<?=$pst->id_posting;?>" id="id_post">


                <?=$pst->html;?>

                <?php if ($pst->id_user != $this->session->userdata('id')): ?>


                <i class="fas fa-exclamation" style="color: tomato;margin-left:10px;"></i>
                <a href="" style="text-decoration:none;">Laporkan</a>


                <?php else: ?>

                <i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
                <a href="<?=base_url();?>profile/deletePost/<?=$pst->id_posting . '/' . $pst->fileName;?>"
                    style="text-decoration:none;" id="delete">Hapus</a>


                <?php endif;?>

                <div class="post-container">
                    <img src="<?=base_url('assets_user/');?>images/<?=$pst->image;?>" alt="user"
                        class="profile-photo-md pull-left" />
                    <div class="post-detail">
                        <div class="user-info">
                            <h5 class="text-info"><?=$pst->name;?></h5>
                            <p class="text-muted">Diunggah pada <?=date('d F Y ', $pst->date_post);?></p>
                        </div>

                        <div class="line-divider"></div>
                        <div class="post-text">
                            <p><?=$pst->caption;?> </p>
                        </div>
                        <div class="line-divider"></div>

                        <div class="post-comment">
                            <a href="<?=base_url('user/getIdposting/') . $pst->id_posting;?>">Komen</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach;?>


            <!-- Post Content
              ================================================= -->




            <!-- Post Content
              ================================================= -->


        </div>

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
                        'ya!<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>'
                }
            }
        }
        </script>

        <script>
        $("#nominal").keyup(function() {
            if ($('#nominal').val() < 10000) {
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