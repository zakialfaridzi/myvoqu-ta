<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">MyVoqu Penghafal and Mentor's Posts Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">MyVoqu Penghafal and Mentor's Posts Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>

        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-download"></i> Export
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="<?php echo base_url('Admin/printPosting'); ?>" target="_blank" rel="noreferrer" class="dropdown-item"><i class="fa fa-print"></i> Print</a>
                <a href="<?php echo base_url('Admin/pdfPosting'); ?>" class="dropdown-item"><i class="fa fa-file"></i> PDF</a>
                <!-- <a href="<?php echo base_url('Admin/excelPosting'); ?>" class="dropdown-item"><i class="fa fa-file"></i> Excel</a> -->
                <!-- <a href="" class="dropdown-item"><i class="fa fa-file"></i> send pdf</a> -->
            </div>
        </div>

        <table class="table mt-2">
            <tr>
                <th>NO</th>
                <th>ID Post</th>
                <th>Caption</th>
                <th>Nama User</th>
                <th>Role</th>
                <th colspan="2">
                    Action
                </th>
            </tr>
            <?php $no = 1;
foreach ($post as $u): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->id_posting ?></td>
                    <td><?php echo $u->caption ?></td>
                    <td><?php echo $u->name ?></td>
                    <?php if ($u->role_id == 2): ?>
                        <td>
                            <?php echo "Penghafal"; ?>
                        </td>
                    <?php elseif ($u->role_id == 3): ?>
                        <td>
                            <?php echo "Mentor"; ?>
                        </td>
                    <?php endif;?>
                    <td>
                        <?php echo anchor('Admin/detailPosting/' . $u->id_posting, '<div class="btn btn-info btn-sm"><i class="fa fa-search-plus"></i> Detail</div>') ?>
                    </td>
                    <td onclick="return confirm('Delete Post?');">
                        <?php echo anchor('Admin/hapusPosting/' . $u->id_posting, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</div>') ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>


</div>