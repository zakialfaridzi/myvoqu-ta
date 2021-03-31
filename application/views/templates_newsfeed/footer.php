<div class="col-md-2 static">
	<div class="suggestions" id="sticky-sidebar">
		<h4 class="grey">Suggestion to Follow</h4>
		<?php foreach ($suggestion as $ou) : ?>
			<div class="follow-user">

				<img src="<?= base_url('assets_user/images/' . $ou->image); ?>" alt="" class="profile-photo-sm pull-left" />
				<div>
					<h5> <?php if ($ou->id == $this->session->userdata('id')) : ?>
							<a href="<?= base_url('profile') ?>"><?= $ou->name; ?></a>
						<?php else : ?>
							<a href="<?= base_url('friend/visitProfile/') . $ou->id; ?>"><?= $ou->name; ?></a>
						<?php endif; ?></h5>
					<form method="post" action="<?= base_url('user/addFollow') . "/" . $this->uri->segment('3'); ?>">
						<input type="hidden" name="id_usertarget" value="<?= $ou->id; ?>">
						<input type="hidden" name="id_userfollow" value="<?= $this->session->userdata('id'); ?>">
						<input type="hidden" name="nama" value="<?= $ou->name; ?>">
						<input type="hidden" name="bio" value="<?= $ou->bio; ?>">
						<input type="hidden" name="image" value="<?= $ou->image; ?>">
						<button class="btn btn-primary" style="background-color: #6fb8df; margin-top: 4px; outline: none;">Follow</button>
					</form>
				</div>
			</div>
		<?php endforeach; ?>

		<div class="">
			<div class="row-5">
				<div class="footer-wrapper">
					<div class="">
						<a href="#"><img src="<?= base_url('assets_login/'); ?>images/mvqq2.png" alt="" style="width: 200px; margin-bottom: 15px;" /></a>
						<ul class="list-inline social-icons" style="margin-left: 20p">
							<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
							<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/myvoqu.id/" target="#"><i class="icon ion-social-instagram"></i></a></li>


						</ul>
					</div>



				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>




<!-- Footer
    ================================================= -->


<!--preloader-->

<div id="spinner-wrapper">


	<div class="spinner"></div>
</div>


<button id="topBtn"> <i class="fa fa-arrow-up" aria-hidden="true"></i></button>

<style>
	#topBtn {
		display: none;
		position: fixed;
		bottom: 40px;
		right: 40px;
		font-size: 22px;
		width: 50px;
		height: 50px;
		background: #0486FE;
		color: white;
		border: 2px solid #0486FE;
		cursor: pointer;
		border-radius: 30px;
		outline: none;
	}
</style>

<!--Buy button-->


<!-- Scripts
    ================================================= -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"> -->
</script>
<script src="<?= base_url('assets_user/'); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/jquery.sticky-kit.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/jquery.scrollbar.min.js"></script>
<script src="<?= base_url('assets_user/'); ?>js/script.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function() {
			if ($(this).scrollTop() > 40) {
				$('#topBtn').fadeIn();
			} else {
				$('#topBtn').fadeOut();
			}
		});

		$("#topBtn").click(function() {
			$('html,body').animate({
				scrollTop: 0
			}, 1500);
		});
	});
</script>




</body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jan 2020 16:01:50 GMT -->

</html>
