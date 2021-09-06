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
						<th>Isi Unggahan</th>
						<th>ID Unggah (ID Post)</th>
						<th>Keterangan (Caption)</th>
						<th>Nama Pengguna</th>
						<th>Tanggal Unggah</th>
						<th colspan="3">
							<center>Aksi</center>
						</th>
					</tr>
					<?php $no = 1;
foreach ($post as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<?php
$word = "video";

if (strpos($u->html, $word) !== false): ?>
					<td>
						<video class="post-video" controls  width="150" height="150" alt="post-video"><source src="<?=base_url()?>assets_user/file_upload/<?=$u->fileName?>" alt="post-video" type="video/mp4"></video>
					</td>
					<?php else: ?>
					<td>
						<img src="<?=base_url()?>assets_user/file_upload/<?=$u->fileName?>" alt="post-image"class="img-responsive post-image"  style="border-radius: 5px 5px 5px 5px; width:100px; height:100px;"/>
					</td>
					<?php endif;?>
						<td><?php echo $u->id_posting ?></td>
						<td><?php echo $u->caption ?></td>
						<td><?php echo $u->name ?></td>
						<td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $u->date_post)); ?></td>
						<?php if ($u->state != 1): ?>
						<td onclick="return confirm('Terbitkan unggahan?');">
							<?php echo anchor('KelolaUnggahanUmum/PublishPostGen/' . $u->id_posting, '<div class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Terbitkan</div>') ?>
						</td>
						<?php else: ?>
						<td>
							<?php echo anchor('KelolaUnggahanUmum/PublishPostGen/' . $u->id_posting, '<div class="d-none"><i class="fa fa-check"></i> G Hidden</div>') ?>
						</td>
						<?php endif;?>
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
