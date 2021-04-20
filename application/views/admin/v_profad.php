<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sunting Data Profil Admin Myvoqu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Sunting Data Profil Admin Myvoqu</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
        <?php foreach ($mahasiswa as $mhs): ?>
            <form action="<?php echo base_url() . 'ProfileAdmin/updateProfile'; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden"  id="old"  name="old"  value="<?php echo $mhs->image ?>">
                    <center><img src="<?php echo base_url() ?>/assets/foto/<?php echo $mhs->image ?>" height="200" width="200" style="border-radius: 50%"></center>
                </div>
                <div class="form-group col-md-7">
                    <label>Nama</label>
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $mhs->id ?>">
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $mhs->name ?>">
                </div>
                <div class="form-group col-md-7">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $mhs->email ?>">
                </div>
                <div class="col-sm-4">
                    <div class="custom-file">
                        <label>Foto</label>
                        <input type="file" class="custom-file-input" id="imageadmin" name="image">
                        <label class="custom-file-label" for="imageadmin">Pilih Berkas</label>
                    </div>
                </div>


                <button type="reset" class="btn btn-danger">Ulangi</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        <?php endforeach;?>
    </div>
</div>
