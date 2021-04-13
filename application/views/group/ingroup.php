<?php foreach ($info as $i) : ?>
	<div id="page-contents">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-7">
				<!-- Post Create Box
                ================================================= -->
				<div class="create-post">
					<div class="row">
						<div class="col-md-7 col-sm-7">
							<div class="form-group">
								<img src="<?= base_url('assets_user/') ?>images/<?= $i->image;  ?>" alt="" class="profile-photo-md" />
								<form action="<?= base_url('group/posting') . "/" . $this->uri->segment('3'); ?>" method="post" enctype="multipart/form-data">
									<textarea cols="30" rows="1" class="form-control" placeholder="Bagikan hafalan mu.." name="caption" id="caption"></textarea>
									<?= form_error('caption', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<div class="tools">
								<ul class="publishing-tools list-inline">
									<li class="nav-item">
										<label for="file-input-gambar">
											<a class="nav-link"><i class="fa fa-camera text-muted"></i></a>
										</label>
										<input type="file" id="file-input-gambar" style="display: none;" name="file">
									</li>
									<li class="nav-item">
										<label for="file-input-video">
											<a class="nav-link"><i class="fa fa-video text-muted"></i></a>
										</label>
										<input type="file" id="file-input-video" style="display: none;" name="video">
									</li>

								</ul>
								<button class="btn btn-primary pull-right" style="background-color: #6fb8df;outline: none;">Upload</button>

								<input type="hidden" value="<?= $this->session->userdata('id'); ?>" name="id_user" id="id_user">
								</form>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div><!-- Post Create Box End-->
				<?= $this->session->flashdata('message'); ?>
				<!-- Post Content
                ================================================= -->
				<?= $this->session->flashdata('mm'); ?>
				<?php foreach ($postingan as $pst) : ?>
					<div class="post-content">
						<div class="post-date hidden-xs hidden-sm">
							<h5></h5>
						</div>
						<form method="POST" action="<?= base_url('group/deletePost/') . $this->uri->segment('3') ?>">
							<input type="hidden" value="<?= $pst->id_posting; ?>" id="id_post" name="id_post">
							<?= $pst->html; ?>
							<?php if ($pst->id_user != $this->session->userdata('id')) : ?>
								<i class="fas fa-exclamation" style="color: tomato;margin-left:10px;"></i>
								<a href="" style="text-decoration:none;">Laporkan</a>
							<?php else : ?>
								<i class="fas fa-trash" style="color: tomato;margin-left:18px;"></i>
								<button type="submit" class="btn btn-danger btn-sm" style="height: 18px; width: 50px;">
									<p style="margin-top: -6px; margin-left: -3px;">Hapus</p>
								</button>
								<!-- <a href="<?= base_url(); ?>group/deletePost/<?= $pst->id_posting; ?>" style="text-decoration:none;" id="delete">Delete</a> -->
								<!-- <i class="fas fa-exclamation" style="color: tomato;margin-left:10px;"></i>
								<a href="" style="text-decoration:none;">Laporkan</a> -->
							<?php endif; ?>
						</form>
						<div class="post-container">
							<img src="<?= base_url('assets_user/'); ?>images/<?= $pst->image; ?>" alt="user" class="profile-photo-md pull-left" />
							<div class="post-detail">
								<div class="user-info">
									<h5><a href="timeline.html" class="profile-link"><?= $pst->name; ?></a></h5>
									<p class="text-muted">Diunggah pada <?= $pst->date_post; ?></p>
								</div>
								<div class="line-divider"></div>
								<div class="post-text">
									<?= $pst->caption; ?>
								</div>
								<div class="line-divider"></div>
								<?= $this->session->flashdata('nn'); ?>
								<div class="post-comment">
									<a href="<?= base_url('group/getIdposting/') . $pst->id_posting; ?>">Beri Komentar</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>


				<!-- Post Content
                ================================================= -->


				<!-- Post Content
                ================================================= -->


			</div>
