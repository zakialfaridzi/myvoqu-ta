<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Unggahan Penghafal dan Mentor MyVoqu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Data Unggahan</li>
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
						<th>Nama Pengguna</th>
						<th>Role (Peranan)</th>
						<th>Isi Unggahan</th>
					</tr>
					<?php $no = 1;
foreach ($post as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $u->id_posting ?></td>
						<td><?php echo $u->caption ?></td>
						<td><?php echo $u->name ?></td>
						<?php if ($u->role_id == 2): ?>
						<td>
							<?php echo "Penghafal"; ?>
						</td>
						<?php elseif ($u->role_id == 3): ?>
						<td>
							<?php echo "Mentor"; ?>
						</td>
						<?php endif;?>
						<td><?php echo $u->html; ?></td>
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