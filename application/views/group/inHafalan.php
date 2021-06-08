<?php foreach ($info as $i) : ?>
	<div id="page-contents">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-7">
				<div id="fp"></div>
				<!-- Post Create Box
                ================================================= -->
				<div class="create-post">
					<div class="row">
						<div class="col-md-7 col-sm-7">
							<div class="form-group">
								<img src="<?= base_url('assets_user/') ?>images/<?= $i->image;  ?>" alt="" class="profile-photo-md" />
								<form action="<?= base_url('group/posting/postingan') . "/" . $this->uri->segment('3'); ?>" method="post" enctype="multipart/form-data">
									<textarea cols="30" rows="1" class="form-control" placeholder="Bagikan hafalan mu.." name="caption" id="caption"></textarea>
									<?= form_error('caption', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<div class="tools">
								<ul class="publishing-tools list-inline">
									<li class="nav-item">
										<label for="file-input-gambar">
											<a class="nav-link"><i class="fas fa-photo-video"></i></a>
										</label>
										<input type="file" id="file-input-gambar" style="display: none;" name="file" multiple onchange="GetFileSizeNameAndType()">
									</li>
								</ul>
								<button class="btn btn-primary pull-right" style="background-color: #6fb8df;outline: none;">Unggah</button>

								<input type="hidden" value="<?= $this->session->userdata('id'); ?>" name="id_user" id="id_user">
								</form>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div><!-- Post Create Box End-->
				<ul class="nav nav-tabs">
					<li role="presentation"><a href="<?= base_url('group/inGroup/').$this->uri->segment('3') ?>">Postingan</a></li>
					<li role="presentation" class="active"><a href="#">Setoran</a></li>
				</ul>
				<?php foreach ($hafalan as $key => $value) { ?>
					<div class="alert alert-info" role="alert">
						Tugas hafalan surah
						<?= $value->nama_surah ?>
						ayat
						<?= $value->from_ayat ?>
						<?php if ($value->to_ayat != null) { ?>
							- <?= $value->to_ayat ?>
							<?php if ($this->session->userdata('role_id') == 2) { ?>
								<button class="btn btn-warning pull-right setorBtn" data-toggle="modal" data-target="#setorHafalan" data-idu="<?= $this->session->userdata('id') ?>" data-nama_surah="<?= $value->nama_surah ?>" data-ayat1="<?= $value->from_ayat ?>" data-ayat2="<?= $value->to_ayat ?>" data-idg="<?= $value->id_group ?>" data-idt="<?= $value->id_tugas ?>"
								<?php 
								foreach ($postHafalan as $key => $pstHafalan) {
									if ($value->id_tugas == $pstHafalan->tugas && $this->session->userdata('id') == $pstHafalan->id_user) {
										echo "disabled";
									}
								}
								?>
								>Setor Hafalan</button>
							<?php }elseif ($this->session->userdata('role_id') == 3) { ?>
                                <button class="btn btn-warning pull-right lihatSetoran" data-toggle="modal" data-target="#listSetoran" data-idu="<?= $this->session->userdata('id') ?>" data-nama_surah="<?= $value->nama_surah ?>" data-ayat1="<?= $value->from_ayat ?>" data-ayat2="<?= $value->to_ayat ?>" data-idg="<?= $value->id_group ?>" data-idt="<?= $value->id_tugas ?>">
                                Lihat Setoran</button>
                            <?php } ?>
						<?php } else { ?>
							<?php if ($this->session->userdata('role_id') == 2) { ?>
								<button class="btn btn-warning pull-right setorBtn" data-toggle="modal" data-target="#setorHafalan" data-idu="<?= $this->session->userdata('id') ?>" data-nama_surah="<?= $value->nama_surah ?>" data-ayat1="<?= $value->from_ayat ?>" data-ayat2="<?= $value->to_ayat ?>" data-idg="<?= $value->id_group ?>" data-idt="<?= $value->id_tugas ?>"
								<?php 
								foreach ($postHafalan as $key => $pstHafalan) {
									if ($value->id_tugas == $postHafalan->tugas && $this->session->userdata('id') == $pstHafalan->id_user) {
										echo "disabled";
									}
								}
								?>
								>Setor Hafalan</button>
							<?php } ?>
						<?php } ?>

					</div>
				<?php } ?>
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
									<a href="<?= base_url('group/getIdposting/') . $pst->id_group . "/" . $pst->id_posting; ?>">Beri Komentar</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>


				<!-- Post Content
                ================================================= -->
				<script type="text/javascript">
					function GetFileSizeNameAndType() {
						var fi = document.getElementById('file-input-gambar'); // GET THE FILE INPUT AS VARIABLE.

						var totalFileSize = 0;

						// VALIDATE OR CHECK IF ANY FILE IS SELECTED.
						if (fi.files.length > 0) {
							// RUN A LOOP TO CHECK EACH SELECTED FILE.
							for (var i = 0; i <= fi.files.length - 1; i++) {
								//ACCESS THE SIZE PROPERTY OF THE ITEM OBJECT IN FILES COLLECTION. IN THIS WAY ALSO GET OTHER PROPERTIES LIKE FILENAME AND FILETYPE
								var fsize = fi.files.item(i).size;
								totalFileSize = totalFileSize + fsize;
								document.getElementById('fp').innerHTML =
									document.getElementById('fp').innerHTML +
									'<div class="alert alert-success alert-dismissible show" role="alert"> Kamu memilih foto/video <strong>' +
									fi.files.
								item(i).name + '</strong > ' +
									'ya!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>'
							}
						}
					}
				</script>

				<!-- Post Content
                ================================================= -->


				<div class="modal fade" id="setorHafalan" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Setor Hafalan</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('group/posting/hafalan/') . $this->uri->segment('3'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" id="idUser" name="id_user" value="">
                                        <input type="hidden" id="idGroup" name="id_group" value="">
                                        <input type="hidden" id="nama_surah" name="nama_surah" value="">
                                        <input type="hidden" id="from_ayat" name="from_ayat" value="">
                                        <input type="hidden" id="to_ayat" name="to_ayat" value="">
                                        <input type="hidden" id="idTugas" name="id_tugas" value="">
                                        <label for="file">Pilih Hafalan</label>
                                        <input type="file" class="form-control" id="file-input-gambar" name="file">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                            </form>
                        </div>

                    </div>
			    </div>

                <div class="modal fade" id="listSetoran" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" id="close-listSetoran" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Yang sudah menghafal</h4>
                            </div>
                            <div class="modal-body">
                                <div class="list-group" id="stored-name">
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close-listSetoran" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>

                    </div>
			    </div>
			</div>

			