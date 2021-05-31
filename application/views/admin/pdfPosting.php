<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Unggahan Penghafal dan Mentor Myvoqu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <table class="table">
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>ID Posting</th>
                <th>Caption</th>
                <th>Tanggal Unggah</th>
                <th>Isi Unggahan</th>
            </tr>

            <?php $no = 1;
foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $mhs->name ?></td>
                    <td><?php echo $mhs->id_posting ?></td>
                    <td><?php echo $mhs->caption ?></td>
                    <td><?php echo date("Y-m-d H:i:s", strtotime('+5 hours', $mhs->date_post)); ?></td>
                    						<?php
$word = "video";

if (strpos($mhs->html, $word) !== false): ?>
					<td>
						<video class="post-video" controls  width="150" height="150"><source src="<?=base_url()?>assets_user/file_upload/<?=$mhs->fileName?>" type="video/mp4"></video>
					</td>
					<?php else: ?>
					<td>
						<img src="<?=base_url()?>assets_user/file_upload/<?=$mhs->fileName?>" alt="post-image"class="img-responsive post-image"  style="border-radius: 5px 5px 5px 5px; width:100px; height:100px;"/>
					</td>
					<?php endif;?>
                </tr>
            <?php endforeach;?>
        </table>
    </div>