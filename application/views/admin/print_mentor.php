<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Mentor MyVoqu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Data Mentor MyVoqu</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="content">
		<?php echo $this->session->flashdata('message'); ?>
		<div class="table-responsive-sm">
			<div class="table-responsive-md">
				<table class="table mt-2">
					<tr>
						<th>NO</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Instansi</th>
						<th colspan="3"	>Status</th>
					</tr>
					<?php $no = 1;
foreach ($mahasiswa as $m): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $m->name ?></td>
						<td><?php echo $m->email ?></td>
						<td><?php echo $m->instansi ?></td>
						<?php if ($m->status == "offline-dot" || $m->status == ""): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Luring</span>"; ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Daring</span>"; ?>
						</td>
						<?php endif;?>
						<?php if ($m->is_active == 2 || $m->is_active == 0): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Tidak Aktif</span>"; ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Aktif</span>"; ?>
						</td>
						<?php endif;?>

						<?php if ($m->verified == 0): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Belum Terverifikasi</span>" ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Terverifikasi</span>" ?>
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
