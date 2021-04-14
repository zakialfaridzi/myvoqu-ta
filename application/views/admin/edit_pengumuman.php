<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sunting Pengumuman Admin MyVoQu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/indexPengumuman/'); ?>">Pengumuman Admin MyVoQu</a></li>
                        <li class="breadcrumb-item active">Sunting Pengumuman Admin MyVoQu</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
    <form action="<?php echo base_url('Admin/updatePengumuman/' . $this->uri->segment(3)); ?>" method="post">
                <div class="form-group">
                    <label>Isi Pengumuman</label>
                    <input type="hidden" name="id" id="id" class="form-control col-3" value="<?php echo $this->uri->segment(3); ?>">
                    <input type="text" name="namapengumuman" id='namapengumuman' class="form-control col-3" value="<?php echo $row2['isi_pengumuman'] ?>"/>
                </div>

                <button type="reset" class="btn btn-danger">Ulangi</button>
                <button type="submit" name="edittodo" class="btn btn-primary">Simpan</button>
            </form>
    </div>
</div>

