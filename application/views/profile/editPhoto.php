<div class="col-md-7">

	<!-- Basic Information
              ================================================= -->
	<div class="edit-profile-container">
		<div class="block-title">
			<h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Edit basic information</h4>
			<div class="line"></div>
			<?php foreach ($info as $i) : ?>
				<p><?= $i->name ?> was created on <?= date('d-F-y', $i->date_created); ?></p>
				<div class="line"></div>
				<?= $this->session->flashdata('message'); ?>
		</div>
		<div class="edit-block">



			<div class="row">
				<?= $this->session->flashdata('mm'); ?>
				<div class="form-group col-xs-12">
					<form action="<?= base_url('profile/updatePhoto'); ?>" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label for="exampleFormControlFile1">Change Your Avatar</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
							<input type="hidden" name="potolama" value="<?= $i->image ?>">
						</div>


				</div>
				<button id="submit" type="submit" class="btn btn-primary" style="background-color:#0486FE; ">Save Changes</button>
			<?php endforeach; ?>
			</form>
			</div>












		</div>
	</div>
</div>
