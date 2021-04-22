<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Penghafal MyVoQu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Data Penghafal MyVoqu</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="content">
		<div class="table-responsive-sm">
			<div class="table-responsive-md">
				<table class="table mt-2">
					<tr>
						<th>NO</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Status Aktivasi</th>
						<th>Status</th>
					</tr>
					<?php $no = 1;
foreach ($mahasiswa as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $u->name ?></td>
						<td><?php echo $u->email ?></td>
						<?php if ($u->is_active == 2 || $u->is_active == 0): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Tidak Aktif</span>"; ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Aktif</span>"; ?>
						</td>
						<?php endif;?>
						<?php if ($u->status == "offline-dot" || $u->status == ""): ?>
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
		</div>
	</div>

</div>


    <script type="text/javascript">
        window.print();
    </script>