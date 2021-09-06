<div class="chat-room">

    <div class="row">
        <div class="col-md-12">




            <!--Chat Messages in Right-->
            <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
                <?php foreach ($getInfoChat as $pst): ?>
                <h3>
                    Ruang Obrolan Bersama <?=$pst->name;?>

                </h3>
                <?php endforeach;?>
                <a href="#downnn">Klik disini untuk gulir kebawah untuk mengirim pesan</a>
                <div class="tab-pane active" id="contact-1">
                    <div class="chat-body">
                        <?php foreach ($pesan3 as $pst): ?>
                        <ul class="chat-message">
                            <?php if ($pst->id_pengirim == $this->session->userdata('id')): ?>
                            <li class="right">
                                <?php else: ?>
                            <li class="left">
                                <?php endif;?>
                                <div class="chat-item">
                                    <div class="chat-item-header">
                                        <h5><?=$pst->name;?></h5>
                                        <small class="text-muted"> <?=date('d F Y h:m:sa ', $pst->date);?></small>
                                    </div>
                                    <p>
                                        <?php
$str = $pst->pesan;
$str = parse_smileys($str, base_url() . 'assets/smileys/');
echo $str;
?></p>
                                </div>
                            </li>


                        </ul>
                        <?php endforeach;?>
                    </div>
                    <div class="send-message" id="downnn">
                        <div class="post-comment" style="height: 250px;">
                            <?php echo smiley_js(); ?>
                            <form method="post"
                                action="<?=base_url('Chat/kirimPesan') . "/" . $this->uri->segment('3');?>">
                                <div class="form-group col-md-9 col-xs-9">
                                    <input type="text" name="isi_pesan" id="comment" class="form-control"
                                        placeholder="Ketik Pesan" maxlength="60">
                                    <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">
                                </div>
                                <div class="form-group col-md-3 col-xs-3">
                                    <input type="submit" class="btn-primary"
                                        style="background-color: #6fb8df; margin-left:-10px; scroll-behavior: smooth;"
                                        value="Kirim">
                                </div>

                            </form>
                            <p>Klik untuk memasukan emoticon</p>
                            <?php echo $smiley_table; ?>

                        </div>
                    </div>
                </div>
            </div>

            <!--Chat Messages in Right End-->
        </div>

    </div>
</div>

</div>