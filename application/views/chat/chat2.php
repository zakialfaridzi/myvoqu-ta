<div class="chat-room">
<?php foreach ($pesan3 as $pst): ?>
    <h3><?php if ($pst->id_pengirim == $this->session->userdata('id')): ?>
        <?php else: ?>
            <?=$pst->name;?>'s room chat
        <?php endif;?>
        </h3>
<?php endforeach;?>
    <div class="row">
        <div class="col-md-12">




            <!--Chat Messages in Right-->
            <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
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
                                            <small class="text-muted">send on <?=date('d F Y h:m:sa ', $pst->date);?></small>
                                        </div>
                                        <p>
                                            <?php
$str = $pst->pesan;
$str = parse_smileys($str, base_url() . 'assets/smileys/');
echo $str;
?></p>
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
                    <div class="send-message">
                <div class="post-comment">
                    <?php echo smiley_js(); ?>
                    <form method="post" action="<?=base_url('Chat/kirimPesan') . "/" . $this->uri->segment('3');?>">
                        <input type="text" name="isi_pesan" id="comment" class="form-control" placeholder="Type your message">
                        <input type="hidden" name="id" value="<?=$this->session->userdata('id');?>">
                        <input type="submit" class="btn-primary" style="height: 45px; margin-left:460px; margin-top: 7px; background-color: #6fb8df;" value="Send">
                    </form>
                    <p>Click to insert a smiley!</p>
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
