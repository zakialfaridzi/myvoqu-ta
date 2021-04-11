<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Print Data Unggahan Penghafal dan Mentor</h1>
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
                <th>ID Post</th>
                <th>Caption</th>
                <th>Nama User</th>
            </tr>
            <?php $no = 1;
foreach ($post as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->id_posting ?></td>
                    <td><?php echo $mhs->caption ?></td>
                    <td><?php echo $mhs->name ?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>