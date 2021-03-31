<!-- <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Group</h2>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $idgroup['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Group</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $idgroup['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Deskripsi</label>
                            <input type="text" name="desc" class="form-control" id="desc" value="<?= $idgroup['desc']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Foto</label>
                            <input type="file" id="file-input-gambar" name="file">
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="col-md-7">

    <!-- Basic Information
              ================================================= -->
    <div class="edit-profile-container">
        <div class="block-title">
            <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Edit basic information</h4>
            <div class="line"></div>
            <div class="line"></div>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <?php foreach ($datagroup as $dg) : ?>
            <div class="edit-block">
                <form action="<?= base_url() . 'Group/updatePhoto/'. $dg['id'] ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" id="id" value="<?= $dg['id']; ?>" hidden>
                    <div class="custom-file">
                        <label>Foto</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                        <label class="custom-file-label" for="image">Choose file</label>
                        <input type="hidden" name="potolama" value="<?= $dg['image']; ?>">
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary" style="background-color:#0486FE; ">Save Changes</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>