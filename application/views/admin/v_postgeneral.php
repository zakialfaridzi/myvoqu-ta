<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Unggah Materi Islami Umum</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Unggah Materi Islami Umum</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>
        <form action="<?php echo base_url() . 'UnggahMateriUmum/postingGen'; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group col-4">
                <label>Caption (Keterangan)</label>
                <input type="hidden" name="id" id="id" class="form-control">
                <textarea cols="30" rows="5" class="form-control" placeholder="Keterangan unggahan" name="caption" id="caption" required></textarea>
            </div>
            <div class="form-group">
                <label for="file-input-gambar">
                    <a class="nav-link"><i class="fa fa-camera text-muted"></i>&<i class="fa fa-video text-muted"></i>&emsp; Foto atau Video <br/> Unggah Materi Islami Umum :</a>
                </label>
                <input type="file" id="file-input-gambar" name="file">
            </div>
            <input type="hidden" value="<?=$this->session->userdata('id');?>" name="id_user" id="id_user">
            <button type="reset" class="btn btn-danger">Ulangi</button>
            <button type="submit" class="btn btn-primary">Unggah</button>
        </form>
    </div>
</div>