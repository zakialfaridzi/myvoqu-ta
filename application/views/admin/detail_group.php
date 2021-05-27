<div class="content-wrapper">
    <div class="content">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Detil Data Grup Hafalan MyVoqu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/'); ?>">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('KelolaGrup') ?>">Data Grup Hafalan MyVoqu</a></li>
                            <li class="breadcrumb-item active">Detil Data Grup Hafalan MyVoqu</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <table class="table">
                <?php foreach ($post as $p): ?>
                    <tr>
                        <th>ID Group</th>
                        <td><?php echo $p->id ?></td>
                    </tr>
                    <tr>
                        <th>Nama Group</th>
                        <td><?php echo $p->nama ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td><?php echo $p->deskripsi ?></td>
                    </tr>
                    <tr>
                        <th>Owner Group</th>
                        <td><?php echo $p->name ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Anggota Group</th>
                        <td><?php echo "<span class='badge badge-primary'>$p->ca</span>" ?></td>
                    </tr>
                    <tr>
                        <th>Anggota Group</th>
                        <td>
                            <?php foreach ($post2 as $p2): ?>
                                <ul>
                                    <li><?php echo $p2->naus ?></li>
                                </ul>
                            <?php endforeach;?>
                        </td>
                    </tr>
                    <tr>
                        <th>Foto Group</th>
                        <td><img src="<?php echo base_url() ?>/assets/img/group/<?php echo $p->image ?>" height="200" width="200" alt=""></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <a href="<?php echo base_url('KelolaGrup'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>