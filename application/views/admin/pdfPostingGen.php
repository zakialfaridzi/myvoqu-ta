<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Unggahan Penghafal dan Mentor Myvoqu</h1>
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
                <th>ID Posting</th>
                <th>Caption</th>
                <th>Tanggal Unggah</th>
                <th>Foto</th>
            </tr>

            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->id_posting ?></td>
                    <td><?php echo $mhs->caption ?></td>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $mhs->date_post)); ?></td>
                    <td><?php echo $mhs->html ?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>