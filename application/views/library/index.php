<?php if ($this->session->userdata('role_id') == 3) : ?>
    <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Tambah Surat
    </button> -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Tambah Surat</button>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Buat Group baru</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Library/addSurat') ?>" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Surat</label>
                            <input type="text" class="form-control" name="nama" placeholder="nama surat">
                            <label for="arti">Arti Dari Surat</label>
                            <input type="text" class="form-control" name="arti" placeholder="artinya">
                            <label for="ayat">Berapa Ayat</label>
                            <input type="text" class="form-control" name="ayat" placeholder="berapa ayat">
                            <label for="suratke">Surat Ke</label>
                            <input type="text" class="form-control" name="suratke" placeholder="surat ke berapa">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
                </form>
            </div>

        </div>
    </div>

<?php endif; ?>

<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <form action="<?= base_url('Library/addSurat') ?>" method="POST">
            <label for="nama">Nama Surat</label>
            <input type="text" class="form-control" name="nama" placeholder="nama surat">
            <label for="arti">Arti Dari Surat</label>
            <input type="text" class="form-control" name="arti" placeholder="artinya">
            <label for="ayat">Berapa Ayat</label>
            <input type="text" class="form-control" name="ayat" placeholder="berapa ayat">
            <label for="suratke">Surat Ke</label>
            <input type="text" class="form-control" name="suratke" placeholder="surat ke berapa">
            <button type="submit" class="btn btn-success" style="float: right;">Add</<button>
        </form>
    </div>
</div>
<br>
<div class="media">
    <?php foreach ($allSurat as $surat) : ?>
        <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;">
            <div class="card" style="width: 18rem;">
                <img src="assets\img\materi\default.jpg" class="card-img-top" alt="..." style="height: 160px; width: 180px;">
                <div class="card-body">
                    <h5 class="card-title"><?= $surat['nama'] ?></h5>
                    <h6 class="card-title">Artinya : <?= $surat['arti'] ?></h6>
                    <h6 class="card-title"><?= $surat['ayat'] ?> Ayat</h6>
                    <h6 class="card-title">Surat ke : <?= $surat['suratke'] ?></h6>
                    <a href="<?= base_url('library/materi/') . $surat['id'] ?>" class="btn btn-primary">Open</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal -->


</div>