<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Print Data Daftar Pengumuman Admin MyVoQu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <table class="table" border="1">
            <tr>
                <th>NO</th>
                <th>Nama Pengumuman</th>
            </tr>
            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->isi_pengumuman ?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>