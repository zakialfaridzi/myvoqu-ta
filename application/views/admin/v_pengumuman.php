<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Pengumuman Admin MyVoQu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Daftar Pengumuman Admin MyVoQu</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>


        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-download"></i> Ekspor
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="<?php echo base_url('Admin/printPengumuman'); ?>" target="_blank" rel="noreferrer" class="dropdown-item"><i class="fa fa-print"></i> Print</a>
                <a href="<?php echo base_url('Admin/pdfPengumuman'); ?>" class="dropdown-item"><i class="fa fa-file"></i> PDF</a>
                <a href="<?php echo base_url('Admin/excelPengumuman'); ?>" class="dropdown-item"><i class="fa fa-file"></i> Excel</a>
            </div>
            &emsp;
        <?php echo anchor('Admin/createPengumuman', '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Buat Pengumuman Baru</button>') ?>
        </div>


        <table class="table mt-2">
            <tr>
                <th>NO</th>
                <th>Isi Pengumuman</th>
                <th>Tanggal Buat</th>
                <th colspan="2">
                    Aksi
                </th>
            </tr>
            <?php $no = 1;
foreach ($pengumuman as $u): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->isi_pengumuman ?></td>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $u->datepost)); ?></td>
					<td>
                       	<?php echo anchor('Admin/editPengumuman/' . $u->id, '<div class="btn btn-info btn-sm"><i class="fa fa-check"></i> Sunting</div>') ?>
                    </td>
					<td onclick="return confirm('Hapus Pengumuman?');">
                        <?php echo anchor('Admin/deletePengumuman/' . $u->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</div>') ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>