<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Unggahan Materi Umum MyVoqu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item">Data Unggahan Materi Umum</li>
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
						<th>ID Unggah (ID Post)</th>
						<th>Keterangan (Caption)</th>
                        <th>Unggahan</th>
					</tr>
					<?php $no = 1;
foreach ($post as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $u->id_posting ?></td>
						<td><?php echo $u->caption ?></td>
<?php $word = "video";
if (strpos($u->html, $word) !== false): ?>
					<td>
						<?=$u->html;?>
					</td>
					<?php else: ?>
					<td>
						<img src="<?=base_url()?>assets_user/file_upload/<?=$u->fileName?>" alt="post-image"class="img-responsive post-image"  style="border-radius: 5px 5px 5px 5px; width:200px; height:200px;"/>
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