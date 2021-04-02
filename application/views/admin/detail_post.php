<div class="content-wrapper">
    <div class="content">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">MyVoqu Penghafal and Mentor's Posts Detail</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                            <li class="breadcrumb-item">MyVoqu Penghafal and Mentor's Posts Data</li>
                            <li class="breadcrumb-item active">MyVoqu Penghafal's Posts Detail</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <table class="table">
                <?php foreach ($post as $p): ?>
                    <?php foreach ($post2 as $p2): ?>
                    <tr>
                        <th>ID Post</th>
                        <td><?php echo $p2->id_posting ?></td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                        <th>Caption</th>
                        <td><?php echo $p->caption ?></td>
                    </tr>
                    <tr>
                        <th>Nama User</th>
                        <td><?php echo $p->name ?></td>
                    </tr>
                    <tr>
                        <th>Role</th>
                    <?php if ($p->role_id == 2): ?>
                        <td>
                            <?php echo "Penghafal"; ?>
                        </td>
                    <?php elseif ($p->role_id == 3): ?>
                        <td>
                            <?php echo "Mentor"; ?>
                        </td>
                    <?php endif;?>
                    </tr>
                    <tr>
                        <th>Count Report</th>
                        <td><span class="badge badge-pill badge-danger"><?php echo $p->cr - 1 ?></span></td>
                    </tr>
                    <tr>
                        <th>Post Date</th>
                        <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $p->date_post)); ?></td>
                    </tr>
                    <tr>
                        <th>Posting</th>
                        <td><?php echo $p->html; ?></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <a href="<?php echo base_url('Admin/indexPosting'); ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>