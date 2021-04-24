<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Unggahan Materi Umum MyVoqu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item">Data Unggahan Materi Umum</li>
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
				<a href="<?php echo base_url('KelolaUnggahanUmum/printPostingGen'); ?>" target="_blank" rel="noreferrer"
					class="dropdown-item"><i class="fa fa-print"></i> Print</a>
				<a href="<?php echo base_url('KelolaUnggahanUmum/pdfPostingGen'); ?>" class="dropdown-item"><i
						class="fa fa-file"></i> PDF</a>
				<a href="<?php echo base_url('KelolaUnggahanUmum/excelPostingGen'); ?>" class="dropdown-item"><i
						class="fa fa-file"></i> Excel</a>
			</div>
		</div>
		<div class="table-responsive-sm">
			<div class="table-responsive-md">
				<table class="table mt-2">
					<tr>
						<th>NO</th>
						<th>ID Unggah (ID Post)</th>
						<th>Keterangan (Caption)</th>
						<th colspan="2">
							Aksi
						</th>
					</tr>
					<?php $no = 1;
foreach ($post as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $u->id_posting ?></td>
						<td><?php echo $u->caption ?></td>
						<td>
							<?php echo anchor('KelolaUnggahanUmum/detailPostingGen/' . $u->id_posting, '<div class="btn btn-info btn-sm"><i class="fa fa-search-plus"></i> Detil</div>') ?>
						</td>
						<td onclick="return confirm('Hapus Unggahan?');">
							<?php echo anchor('KelolaUnggahanUmum/HapusPostGen/' . $u->id_posting, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</div>') ?>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>


</div>
