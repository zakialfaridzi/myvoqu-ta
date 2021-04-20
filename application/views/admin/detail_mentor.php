<div class="content-wrapper">
    <div class="content">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Detil Data Mentor MyVoqu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
                            <li class="breadcrumb-item">Data Mentor MyVoqu</li>
                            <li class="breadcrumb-item active">Detil Data Mentor MyVoqu</li>
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
                    <th>Grup yang diajar</th>
					<td>
                    <?php foreach ($allgroup as $group): if ($group['owner'] == $detail->id) {?>
									        <ul>
									            <li><?=$group['nama'];?></li>
									        </ul>
									    <?php }
endforeach;?>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Registrasi</th>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $detail->date_created)); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <?php if ($detail->status == "offline-dot" || $detail->status == ""): ?>
                        <td>
                            <?php echo "<span class='badge badge-danger'>Luring</span>"; ?>
                        </td>
                    <?php else: ?>
                        <td>
                                <?php echo "<span class='badge badge-primary'>Daring</span>"; ?>
                            </td>
                    <?php endif;?>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <?php if ($detail->verified == 2 || $detail->verified == 0): ?>
                        <td>
                            <?php echo "<span class='badge badge-danger'>Belum Terverifikasi</span>"; ?>
                        </td>
                    <?php else: ?>
                        <td>
                            <?php echo "<span class='badge badge-primary'>Terverifikasi</span>"; ?>
                        </td>
                    <?php endif;?>
                </tr>
                <tr>
                    <th>Status Aktivasi</th>
                    <?php if ($detail->is_active == 2 || $detail->is_active == 0): ?>
                        <td>
                            <?php echo "<span class='badge badge-danger'>Tidak Aktif</span>"; ?>
                        </td>
                    <?php else: ?>
                        <td>
                            <?php echo "<span class='badge badge-primary'>Aktif</span>"; ?>
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
            <a href="<?php echo base_url('KelolaMentor'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>