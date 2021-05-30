<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Daftar Kegiatan Admin MyVoQu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Buat</th>
                <th>Status</th>
            </tr>

            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->task_name ?></td>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $mhs->datepost)); ?></td>
                    <?php if ($mhs->state == '1'): ?>
                        <td><?php echo "Selesai" ?></td>
                    <?php else: ?>
                        <td><?php echo "Belum Selesai" ?></td>
                    <?php endif;?>
                </tr>
            <?php endforeach;?>
        </table>
    </div>