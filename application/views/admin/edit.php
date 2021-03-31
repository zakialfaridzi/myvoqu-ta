<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit MyVoqu Penghafal Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                        <li class="breadcrumb-item">MyVoqu Penghafal Data</li>
                        <li class="breadcrumb-item active">Edit MyVoqu Penghafal Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <?php foreach ($mahasiswa as $mhs) : ?>
            <form action="<?php echo base_url() . 'Admin/updatePenghafal'; ?>" method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $mhs->id ?>">
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $mhs->name ?>">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="gender" id="gender" class="form-control" value="<?php echo $mhs->gender ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $mhs->email ?>">
                </div>

                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        <?php endforeach; ?>
    </div>
</div>