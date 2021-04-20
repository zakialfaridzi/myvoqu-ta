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

		<div class="dropdown">
			<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-download"></i> Ekspor
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a href="<?php echo base_url('KelolaMentor/printMentor'); ?>" target="_blank" rel="noreferrer"
					class="dropdown-item"><i class="fa fa-print"></i> Print</a>
				<a href="<?php echo base_url('KelolaMentor/pdfMentor'); ?>" class="dropdown-item"><i class="fa fa-file"></i>
					PDF</a>
				<a href="<?php echo base_url('KelolaMentor/excelMentor'); ?>" class="dropdown-item"><i class="fa fa-file"></i>
					Excel</a>

			</div>
		</div>
		<div class="table-responsive-sm">
			<div class="table-responsive-md">
				<table class="table mt-2">
					<tr>
						<th>NO</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Instansi</th>
						<th>Status</th>
						<th colspan="5">
							<center>Aksi</center>
						</th>
					</tr>
					<?php $no = 1;
foreach ($mentor as $m): ?>
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
						<td>
							<?php echo anchor('KelolaMentor/detailMentor/' . $m->id, '<div class="btn btn-info btn-sm"><i class="fa fa-search-plus"></i> Detil</div>') ?>
						</td>
						<?php if ($m->verified == 0): ?>
						<td onclick="return confirm('Verifikasi Mentor?');">
							<?php echo anchor('KelolaMentor/verifyMentor/' . $m->id, '<div class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Verifikasi</div>') ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo '<div class="btn btn-primary btn-sm"> Terverifikasi</div>' ?>
						</td>
						<?php endif;?>
						<?php if ($m->is_active == 2 || $m->is_active == 0): ?>
						<td onclick="return confirm('Aktivasi Mentor?');">
							<?php echo anchor('KelolaMentor/activateMentor/' . $m->id, '<div class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Aktivasi</div>') ?>
						</td>
						<?php else: ?>
						<td onclick="return confirm('Non Aktivasi Mentor?');">
							<?php echo anchor('KelolaMentor/deactivateMentor/' . $m->id, '<div class="btn btn-warning btn-sm"><i class="fas fa-exclamation-triangle"></i> Non Aktivasi</div>') ?>
						</td>
						<?php endif;?>
						<td onclick="return confirm('Hapus Mentor?');">
							<?php echo anchor('KelolaMentor/hapusMentor/' . $m->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</div>') ?>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>


</div>



<?=$this->session->flashdata('toast')?>
