<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Pengumuman Admin MyVoQu</h1>
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
                <th>Isi Pengumuman</th>
                <th>Pembuat</th>
                <th>Tanggal Buat</th>
            </tr>

            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->isi_pengumuman ?></td>
                    <td><?php echo $mhs->name ?></td>
					<td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $mhs->datepost)); ?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>