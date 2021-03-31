<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">MyVoqu General Posts Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">MyVoqu General Posts Data</li>
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
                <a href="<?php echo base_url('Admin/printPostingGen'); ?>" target="_blank" rel="noreferrer" class="dropdown-item"><i class="fa fa-print"></i> Print</a>
                <a href="<?php echo base_url('Admin/pdfPostingGen'); ?>" class="dropdown-item"><i class="fa fa-file"></i> PDF</a>
                <a href="<?php echo base_url('Admin/excelPostingGen'); ?>" class="dropdown-item"><i class="fa fa-file"></i> Excel</a>
            </div>
        </div>

        <table class="table mt-2">
            <tr>
                <th>NO</th>
                <th>ID Post</th>
                <th>Caption</th>
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
                    <td>
                        <?php echo anchor('Admin/detailPostingGen/' . $u->id_posting, '<div class="btn btn-info btn-sm"><i class="fa fa-search-plus"></i> Detail</div>') ?>
                    </td>
                    <td onclick="return confirm('Delete Post?');">
                        <?php echo anchor('Admin/DelPosGen/' . $u->id_posting, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</div>') ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>


</div>