<script src="<?php echo base_url() ?>/assets/plugins/chart.js/Chart.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php foreach ($count as $c): ?>
                                    <h3><?=$c->jumlah;?></h3>
                                <?php endforeach;?></h3>
                            <p>Penghafal</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?php echo base_url('KelolaPenghafal/'); ?>" class="small-box-footer">Info Lebih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php foreach ($countmentor as $cm): ?>
                                    <h3><?=$cm->jumlahmentor;?></h3>
                                <?php endforeach;?></h3>

                            <p>Mentor</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="<?php echo base_url('KelolaMentor/'); ?>" class="small-box-footer">Info Lebih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php foreach ($countgroup as $cg): ?>
                                    <h3><?=$cg->jumlahgroup;?></h3>
                                <?php endforeach;?></h3>

                            <p>Grup Hafalan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-chatboxes"></i>
                        </div>
                        <a href="<?php echo base_url('KelolaGrup/') ?>" class="small-box-footer">Info Lebih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php foreach ($countpost as $cd): ?>
                                    <h3><?=$cd->jumlahpost;?></h3>
                                <?php endforeach;?></h3>

                            <p>Unggahan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-upload"></i>
                        </div>
                        <a href="<?php echo base_url('KelolaUnggahan/'); ?>" class="small-box-footer">Info Lebih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Grafik Instansi Mentor yang Sudah Terverifikasi
                            </h3>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <canvas id="myChart2" width="3000" height="1500"></canvas>
                                    <?php
//Inisialisasi nilai variabel awal
$nama2 = "";
$jumlah2 = null;
foreach ($hasil2 as $item2) {
    $jur2 = $item2->instansi;
    $nama2 .= "'$jur2'" . ", ";
    $jum2 = $item2->total;
    $jumlah2 .= "$jum2" . ", ";
}
?>
                                    <script>
                                        var ctx = document.getElementById('myChart2').getContext('2d');
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'bar',
                                            // The data for our dataset
                                            data: {
                                                labels: [<?php echo $nama2; ?>],
                                                datasets: [{
                                                    label: 'Instansi',
                                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                                                    borderColor: ['rgb(255, 99, 132)'],
                                                    data: [<?php echo $jumlah2; ?>]
                                                }]
                                            },
                                            // Configuration options go here
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </section>

                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Grafik Gender Penghafal
                            </h3>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <canvas id="myChart" width="1000" height="500"></canvas>
                                    <?php
//Inisialisasi nilai variabel awal
$nama = "";
$jumlah = null;
foreach ($hasil as $item) {
    $jur = $item->gender;
    $nama .= "'$jur'" . ", ";
    $jum = $item->total;
    $jumlah .= "$jum" . ", ";
}
?>
                                    <script>
                                        var ctx = document.getElementById('myChart').getContext('2d');
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'doughnut',
                                            // The data for our dataset
                                            data: {
                                                labels: [<?php echo $nama; ?>],
                                                datasets: [{
                                                    label: 'User Gender Data ',
                                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                                                    borderColor: ['rgb(255, 99, 132)'],
                                                    data: [<?php echo $jumlah; ?>]
                                                }]
                                            },
                                            // Configuration options go here
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </section>

                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Grafik Unggahan Penghafal dan Mentor
                            </h3>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <canvas id="myChart3" width="1000" height="500"></canvas>
                                    <?php
//Inisialisasi nilai variabel awal
$nama = "";
$jumlah = null;
foreach ($hasil3 as $item) {
    $jur = $item->name;
    $nama .= "'$jur'" . ", ";
    $jum = $item->total;
    $jumlah .= "$jum" . ", ";
}
?>
                                    <script>
                                        var ctx = document.getElementById('myChart3').getContext('2d');
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'pie',
                                            // The data for our dataset
                                            data: {
                                                labels: [<?php echo $nama; ?>],
                                                datasets: [{
                                                    label: 'Penghafal Posting Data ',
                                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                                                    borderColor: ['rgb(255, 99, 132)'],
                                                    data: [<?php echo $jumlah; ?>]
                                                }]
                                            },
                                            // Configuration options go here
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </section>

                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Charts Role_id (Id_Peran)
                            </h3>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <canvas id="myChart4" width="1000" height="500"></canvas>
                                    <?php
//Inisialisasi nilai variabel awal
$nama = "";
$jumlah = null;
foreach ($hasil4 as $item) {
    $jur = $item->role_id;
    $nama .= "'$jur'" . ", ";
    $jum = $item->total;
    $jumlah .= "$jum" . ", ";
}
?>
                                    <script>
                                        var ctx = document.getElementById('myChart4').getContext('2d');
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'pie',
                                            // The data for our dataset
                                            data: {
                                                labels: [<?php echo $nama; ?>],
                                                datasets: [{
                                                    label: 'role_id Data ',
                                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                                                    borderColor: ['rgb(255, 99, 132)'],
                                                    data: [<?php echo $jumlah; ?>]
                                                }]
                                            },
                                            // Configuration options go here
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                                <span>*1 = Admin, 2 = Penghafal, 3 = Mentor</span>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">

                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Pengunjung MyVoQu
                            </h3>
                            <!-- card tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div id="vmap" style="height: 193px; width: 100%;"></div>
                        </div>
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div class="text-white">Penghafal yang sedang daring</div>
                                    <?php foreach ($countonline as $co): ?>
                                        <h3><?=$co->jumlahonline;?></h3>
                                    <?php endforeach;?>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div class="text-white">Mentor yang sedang daring</div>
                                    <?php foreach ($countmentoronline as $ca): ?>
                                        <h3><?=$ca->jumlahmentoronline;?></h3>
                                    <?php endforeach;?>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div class="text-white">Jumlah Grup Hafalan</div>
                                    <?php foreach ($countgroup as $c): ?>
                                        <h3><?=$c->jumlahgroup;?></h3>
                                    <?php endforeach;?>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->