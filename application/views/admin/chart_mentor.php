<script src="<?php echo base_url() ?>/assets/plugins/chart.js/Chart.js"></script>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Charts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Charts</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">

        <body>
            <br>
            <h4>Mentor Agency Data Chart</h4>
            <canvas id="myChart2" width="2000" height="500"></canvas>
            <?php
            //Inisialisasi nilai variabel awal
            $nama2 = "";
            $jumlah2 = null;
            foreach ($hasil as $item2) {
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
                            label: 'Mentor Agency Data Chart',
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
            <br><br>
            <a href="<?php echo base_url('Admin/index'); ?>" class="btn btn-primary">Back</a>
        </body>
    </div>
</div>