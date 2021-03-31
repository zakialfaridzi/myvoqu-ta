<div class="row">
    <!-- <div class="col-md-6"> -->
        <div class="card">
            <div class="card-header">
                <h2>Buat Group Baru</h2>
            </div>
            <!-- <div class="card-body"> -->
                <form action="" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $this->session->userdata('id'); ?>">
                        <label for="nama">Nama Group</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Contoh : Group hafalan surah Al-Baqarah">
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                        <label for="nama">Deskripsi Group</label>
                        <input type="text" name="desc" class="form-control" id="desc" placeholder="Deskripsi Group">
                        <small class="form-text text-danger"><?= form_error('Deskripsi'); ?></small>
                        <input type="text" name="image" id="image" value="default.png" hidden>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary float-right">Buat Group</button>
                </form>
            <!-- </div> -->
        </div>
    <!-- </div> -->
</div>
</div>