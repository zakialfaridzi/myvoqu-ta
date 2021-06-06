<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Grup Hafalan MyVoqu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Data Grup Hafalan MyVoqu</li>
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
						<th>Foto Grup</th>
						<th>Nama Grup</th>
						<th>Deskripsi</th>
						<th>Pemilik Grup</th>
					</tr>
					<?php $no = 1;
foreach ($mahasiswa as $m): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><img src="<?php echo base_url() ?>/assets/img/group/<?php echo $m->img ?>" height="100" width="100" alt=""></td>
						<td><?php echo $m->nama ?></td>
						<td><?php echo $m->deskripsi ?></td>
						<td><?php echo $m->name ?></td>
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