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
							<li><a href="<?= base_url('./Chat') ?>" target="_blank" class="<?= $active; ?>">Chat Group</a></li>
							<li><a href="<?= base_url('./cc'); ?>" target="_blank" class="<?= $active; ?>">Quiz</a></li>
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
				<a href="<?= base_url('profile/editProfile') ?>" class="btn-primary" style="text-decoration: none;">Edit Porfile</a>
			</div>
			</div>
			<!--Timeline Menu for Small Screens End-->

		</div>