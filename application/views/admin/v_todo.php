<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Membuat Daftar Kegiatan Admin MyVoQu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/'); ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Daftar Kegiatan Admin MyVoQu</li>
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
				<a href="<?php echo base_url('ToDoListAdmin/printTodo'); ?>" target="_blank" rel="noreferrer"
					class="dropdown-item"><i class="fa fa-print"></i> Print</a>
				<a href="<?php echo base_url('ToDoListAdmin/pdfTodo'); ?>" class="dropdown-item"><i class="fa fa-file"></i>
					PDF</a>
				<a href="<?php echo base_url('ToDoListAdmin/excelTodo'); ?>" class="dropdown-item"><i class="fa fa-file"></i>
					Excel</a>
			</div>
			&emsp;
			<?php echo anchor('ToDoListAdmin/createTodo', '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Buat Kegiatan Baru</button>') ?>
		</div>

		<div class="table-responsive-sm">
			<div class="table-responsive-md">
				<table class="table mt-2">
					<tr>
						<th>NO</th>
						<th>Nama Kegiatan</th>
						<th colspan="5">
							<center>Aksi</center>
						</th>
					</tr>
					<?php $no = 1;
foreach ($todo as $u): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $u->task_name ?></td>
						<?php if ($u->state != 1): ?>
						<td onclick="return confirm('Selesaikan Kegiatan?');">
							<?php echo anchor('ToDoListAdmin/doneTodo/' . $u->id, '<div class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Selesai</div>') ?>
						</td>
						<?php else: ?>
						<td onclick="return confirm('Belum Selesaikan Kegiatan?');">
							<?php echo anchor('ToDoListAdmin/undoneTodo/' . $u->id, '<div class="btn btn-danger btn-sm"><i class="fas fa-check"></i> Belum Selesai</div>') ?>
						</td>
						<?php endif;?>
						<td>
							<?php echo anchor('ToDoListAdmin/editTodo/' . $u->id, '<div class="btn btn-info btn-sm"><i class="fa fa-check"></i> Sunting</div>') ?>
						</td>
						<td onclick="return confirm('Hapus Kegiatan?');">
							<?php echo anchor('ToDoListAdmin/deleteTodo/' . $u->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</div>') ?>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>
</div>
