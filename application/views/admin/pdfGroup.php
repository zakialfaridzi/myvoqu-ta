<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Grup Myvoqu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <table class="table">
            <tr>
                <th>NO</th>
                <th>Nama Group</th>
                <th>Deskripsi</th>
                <th>Pemilik Grup</th>
                <th>Foto Group</th>
            </tr>

            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->nama ?></td>
                    <td><?php echo $mhs->deskripsi ?></td>
                    <td><?php echo $mhs->name ?></td>
					<td><img src="<?php echo base_url() ?>/assets/img/group/<?php echo $mhs->img ?>" height="100" width="100" alt=""></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>