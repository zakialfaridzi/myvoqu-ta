<div class="content-wrapper">
	<div class="content">

		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">MyVoqu General Posts Detail</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
							<li class="breadcrumb-item">MyVoqu General Posts Data</li>
							<li class="breadcrumb-item active">MyVoqu General Posts Detail</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->

			<table class="table">
				<tr>
					<th>ID Post</th>
					<td><?php echo $post->id_posting ?></td>
				</tr>
				<tr>
					<th>Caption</th>
					<td><?php echo $post->caption ?></td>
				</tr>
				<tr>
                    <th>Post Date</th>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $post->date_post)); ?></td>
                </tr>
				<tr>
					<th>Posting</th>
					<td><?php echo $post->html; ?></td>
				</tr>
			</table>
			<a href="<?php echo base_url('Admin/indexPostingGen'); ?>" class="btn btn-primary">Back</a>
		</div>
	</div>
</div>
