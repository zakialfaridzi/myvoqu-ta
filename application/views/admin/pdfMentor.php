<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Mentor Myvoqu</h1>
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
                <th>Nama</th>
                <th>Instansi</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Status Aktivasi</th>
				<th>Status</th>
            </tr>

            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->name ?></td>
                    <td><?php echo $mhs->instansi ?></td>
                    <td><?php echo $mhs->email ?></td>
                    <?php if ($mhs->gender == "Male"): ?>
						<td>
							<?php echo "Laki Laki"; ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "Perempuan"; ?>
						</td>
					<?php endif;?>
                    <?php if ($mhs->is_active == 2 || $mhs->is_active == 0): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Tidak Aktif</span>"; ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Aktif</span>"; ?>
						</td>
					<?php endif;?>
					<?php if ($mhs->status == "offline-dot" || $mhs->status == ""): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Luring</span>"; ?>
						</td>
					<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Daring</span>"; ?>
						</td>
					<?php endif;?>
                </tr>
            <?php endforeach;?>
        </table>
    </div>