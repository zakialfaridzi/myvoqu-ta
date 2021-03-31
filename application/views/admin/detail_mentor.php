<div class="content-wrapper">
    <div class="content">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">MyVoqu Mentors Data Detail</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">MyVoqu Mentors Data Detail</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <table class="table">
                <tr>
                    <th>Nama Mentor</th>
                    <td><?php echo $detail->name ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $detail->email ?></td>
                </tr>
                <tr>
                    <th>Instansi</th>
                    <td><?php echo $detail->instansi ?></td>
                </tr>
                <tr>
                    <th>Create Date</th>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $detail->date_created)); ?></td>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <?php if ($detail->verified == 2 || $detail->verified == 0): ?>
                        <td>
                            <?php echo "<span class='badge badge-danger'>Not Verified</span>"; ?>
                        </td>
                    <?php else: ?>
                        <td>
                            <?php echo "<span class='badge badge-primary'>Verified</span>"; ?>
                        </td>
                    <?php endif;?>
                </tr>
                <tr>
                    <th>Status Aktivasi</th>
                    <?php if ($detail->is_active == 2 || $detail->is_active == 0): ?>
                        <td>
                            <?php echo "<span class='badge badge-danger'>Not Activated</span>"; ?>
                        </td>
                    <?php else: ?>
                        <td>
                            <?php echo "<span class='badge badge-primary'>Activated</span>"; ?>
                        </td>
                    <?php endif;?>
                </tr>
                <tr>
                    <th>Foto Mentor</th>
                    <td><img src="<?php echo base_url(); ?>assets_user/images/<?php echo $detail->image; ?>" width="150" height="150"></td>
                </tr>
                <tr>
                    <th>Sertifikat</th>
                    <td><img src="<?php echo base_url(); ?>assets/foto/<?php echo $detail->sertif; ?>" width="150" height="150"></td>
                </tr>
            </table>
            <a href="<?php echo base_url('Admin/indexMentor'); ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>