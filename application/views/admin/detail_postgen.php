<div class="content-wrapper">
	<div class="content">

		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Detil Unggahan Materi Umum MyVoqu</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
							<li class="breadcrumb-item">Data Unggahan Materi Umum</li>
							<li class="breadcrumb-item active">Detil Unggahan Materi Umum MyVoqu</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->

			<table class="table">
				<tr>
					<th>ID Unggahan (ID Post)</th>
					<td><?php echo $post->id_posting ?></td>
				</tr>
				<tr>
					<th>Keterangan (Caption)</th>
					<td><?php echo $post->caption ?></td>
				</tr>
				<tr>
                    <th>Tanggal Unggah</th>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $post->date_post)); ?></td>
                </tr>
				<tr>
					<th>Unggahan</th>
					<?php
$word = "video";

if (strpos($post->html, $word) !== false): ?>
					<td>
						<?=$post->html;?>
					</td>
					<?php else: ?>
					<td>
						<img src="<?=base_url()?>assets_user/file_upload/<?=$post->fileName?>" alt="post-image"class="img-responsive post-image"  style="border-radius: 5px 5px 5px 5px; width:466px; height:350px;"/>
					</td>
					<?php endif;?>
				</tr>
			</table>
			<a href="<?php echo base_url('KelolaUnggahanUmum'); ?>" class="btn btn-primary">Kembali</a>
		</div>
	</div>
</div>

