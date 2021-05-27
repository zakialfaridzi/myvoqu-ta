<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Membuat Daftar Kegiatan Admin MyVoQu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Daftar Kegiatan Admin MyVoQu</li>
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
						<th>Nama Kegiatan</th>
						<th>Status</th>
					</tr>
					<?php $no = 1;
foreach ($mahasiswa as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $u->task_name ?></td>
						<?php if ($u->state != 1): ?>
						<td>
							<?php echo "<span class='badge badge-danger'>Belum Selesai</span>" ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo "<span class='badge badge-primary'>Selesai</span>" ?>
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