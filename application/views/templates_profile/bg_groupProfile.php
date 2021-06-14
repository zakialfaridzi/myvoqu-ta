<div class="container">

	<!-- Timeline
      ================================================= -->
	<div class="timeline">
		<div class="timeline-cover">

			<!--Timeline Menu for Large Screens-->
			<div class="timeline-nav-bar hidden-sm hidden-xs">
				<div class="row">
					<div class="col-md-3">
						<div class="profile-info">
							<?php foreach ($info as $i) : ?>
								<?php foreach ($datagroup as $nama) : ?>
									<img src="<?= base_url('assets/') . 'img/group/' . $nama['image'] ?>" alt="" class="img-responsive profile-photo" />
									<h3 style="color: #6fb8df;"><?= $nama['nama']; ?></h3>
									<p class="text-muted"><?= $nama['deskripsi']; ?></p>
						</div>
					</div>
					<div class="col-md-9">
						<ul class="list-inline profile-menu">
							<li><a href="<?= base_url('group/inGroup') . "/" . $nama['id']; ?>" class="<?= $active; ?>">Beranda</a></li>
							<!-- <li><a href="#" class="<?= $active; ?>">Materi</a></li> -->
							<li><a href="<?= base_url('group/listAnggota') . "/" . $nama['id']; ?>" class="<?= $active; ?>">Anggota</a></li>
							<li><a href="<?= base_url('group/info') . "/" . $nama['id']; ?>" class="<?= $active; ?>">Informasi</a></li>
							<li><a href="<?= base_url('group/chatGroup/') . $nama['id']; ?>" class="<?= $active; ?>">Chat Group</a></li>
							<li><a href="<?= base_url('./cc'); ?>" target="_blank" class="<?= $active; ?>">Quiz</a></li>

							<?php if ($user['role_id'] == 3) { ?>
								<li><a href="#" target="_blank" data-toggle="modal" data-target="#penugasan" class="<?= $active; ?>">Penugasan Hafalan</a></li>
							<?php } ?>
							<!-- <li><a href="#" class="<?= $active; ?>">Ulangan</a></li> -->
						</ul>
						<ul class="follow-me list-inline">
							<?php if ($user['role_id'] == 3) { ?>
								<li>
									<a href="<?= base_url(); ?>group/ubahGroup/<?= $nama['id']; ?>" class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Ubah Group</a>
								</li>
							<?php } ?>
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<!--Timeline Menu for Large Screens End-->

			<!--Timeline Menu for Small Screens-->
			<div class="navbar-mobile hidden-lg hidden-md">
				<div class="profile-info">
					<img src="<?= base_url('assets_user/') ?>images/<?= $i->image ?>" alt="" class="img-responsive profile-photo" />
					<h4><?= $i->name; ?></h4>
					<p class="text-muted"><?= $i->work; ?></p>
				</div>
			<?php endforeach; ?>
			<div class="mobile-menu">
				<ul class="list-inline">
					<li><a href="timline.html" class="active">Beranda</a></li>
					<li><a href="timeline-about.html">Anggota</a></li>
					<li><a href="timeline-album.html">Informasi</a></li>
					<li><a href="timeline-friends.html">Chat Group</a></li>
				</ul>
				<a href="<?= base_url('profile/editProfile') ?>" class="btn-primary" style="text-decoration: none;">Ubah Grup</a>
			</div>
			</div>
			<!--Timeline Menu for Small Screens End-->

			<!-- Modal -->
			<div class="modal fade" id="penugasan" role="dialog">
				<div class="modal-dialog modal-sm">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Penugasan Hafalan</h4>
						</div>
						<div class="modal-body" id="modal_view">
							<p>Report Penugasan Hafalan <button class="btn btn-info" data-toggle="modal" data-target="#table-report-hafalan">Lihat</button></p>
							<?php foreach ($hafalan as $key => $value) { ?>
								<div class="list-group">
									<a href="#" class="list-group-item list-group-item-action DetailPenugasan" id="DetailPenugasan" data-toggle="modal" data-target="#statistik" data-id="<?= $value->id_tugas ?>"><?= "Hafalan " . $value->nama_surah . " Ayat " . $value->from_ayat . "-" . $value->to_ayat ?></a>
								</div>
							<?php } ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="statistik" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Setoran Hafalan</h4>
						</div>
						<div class="modal-body" id="modal_view">
							<h5>Sudah Setor</h5>
							<ul class="list-group" id="sudah-setor">
								<!-- <li class="list-group-item"></li> -->
							</ul>
							<h5>Belum Setor</h5>
							<ul class="list-group" id="belum-setor">
								<!-- <li class="list-group-item"><span class="pull-right" style="font-size: 1em; color: red;"><i class="fas fa-times-circle"></i></span>Namanya</li> -->
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default closeModalPenugasan" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="table-report-hafalan" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-md">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Laporan penugasan hafalan</h4>
						</div>
						<div class="modal-body" id="modal_view">
							<div class="table-responsive">
								<!-- <?php var_dump($reportHafalan) ?> -->
								<table id="table_report" class="table table_report">
									<thead>
										<tr>
											<?php
											if ($columnReport != 'Tidak ada data') {
												foreach ($columnReport->list_fields() as $key) {
													if ($key == 'name') {
														echo "<th>Nama Penghafal</th>";
													} else { ?>
														<th><?= str_replace("*", " ", $key); ?></th>
													<?php } ?>
											<?php
												}
											} else {
											}
											?>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($reportHafalan != null) {
											foreach ($reportHafalan as $traine) :
												echo "<tr>";
												$tds = get_object_vars($traine);
												foreach ($tds as $property => $value) {
													if ($traine->{$property} == '1') {
														echo "<td><span style='font-size: 1em; color: green;'><i class='fas fa-check-circle'></i></span></td>";
													} elseif ($traine->{$property} == '0') {
														echo "<td><span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span></td>";
													} else {
														echo sprintf("<td>%s</td>", $traine->{$property});
													}
												}
												echo "</tr> ";
											endforeach;
										}else{
											echo "<center>Belum ada penugasan</center>";
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default closeModalPenugasan" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>

		</div>