<!-- Chat Room
            ================================================= -->
<div class="chat-room">
  <b> All Message Received</b>


  <a href="<?= base_url('chat/pilihUser'); ?>" style='float:right; color:white; background-color: #6FB8DF; border:none; border-radius: 10px;'><b> &nbsp;Send message&nbsp;</b></a>
  <div class="row">
    <div class="col-md-12">

      <!-- Contact List in Left-->

      <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">

        <?php foreach ($pesan as $pst) : ?>

          <li class="active">
            <a href="<?= base_url('chat/chat2/') . $pst->id; ?>">
              <div class="contact">
                <img src="<?= base_url('assets_user/') ?>images/<?= $pst->image; ?>" alt="" class="profile-photo-sm pull-left" />
                <div class="msg-preview">
                  <h6><?= $pst->name; ?></h6>

                  <p class="text-muted"><?= $pst->pesan; ?></p>
                  <small class="text-muted"><?= date('h:m:sa ', $pst->date); ?></small>

                  <!-- <p class="text-muted">Hallo brooo!!</p>
                  <small class="text-muted">05.00.34pm</small> -->

                  <!-- <div class="chat-alert">1</div> -->
                </div>
              </div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
      <!--Contact List in Left End-->
    </div>
    <!--Chat Messages in Right End-->
  </div>
</div>
</div>