<?php

//grafik jumlah Dokumen by Jenis
foreach ( $data['grafikJenis'] as $DocByJenis ):
    $jenisdoc[] = $DocByJenis['jenis'];
    $totaldoc[] = $DocByJenis['qty'];
endforeach;

//grafik jumlah Dokumen by Type
foreach ( $data['grafikType'] as $DocByType ):
    $typedoc[] = $DocByType['type'];
    $totaltype[] = $DocByType['qty'];
endforeach;

// var_dump($totaldoc);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-dark">Dashboard Dokumen Kontrol</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total biaya -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Dokumen</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">200</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-coins fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Total wo -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jenis Dokumen</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Total wo -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dokumen Baru</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- open -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Download</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-play-circle fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card h-100 shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-dark">
                <h6 class="m-0 text-warning">Jumlah Dokumen Berdasarkan Jenis Dokumen</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                        <canvas id="jenisDocChart" style="max-height: 500px;"></canvas>         
    
                    <!-- //grafik jumlah wo -->
                    <script>
                        var ctx = document.getElementById('jenisDocChart').getContext('2d');
                        var jenisDocChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?= json_encode($jenisdoc); ?>,
                                datasets: [{
                                    label: 'Jumlah Dokumen',
                                    data: <?= json_encode($totaldoc); ?>,
                                    backgroundColor: [
                                        'rgba(102, 181, 248, 1)',
                                        'rgba(245, 197, 29, 1)',
                                        'rgba(255, 92, 70, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(29, 219, 72, 1)',
                                        'rgba(70, 255, 204, 1)',
                                        'rgba(213, 255, 115, 1)',
                                        'rgba(250, 202, 195 , 1)'
                                    ],
                                    borderColor: [
                                        'rgba(102, 181, 248, 1)',
                                        'rgba(245, 197, 29, 1)',
                                        'rgba(255, 92, 70, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(29, 219, 72, 1)',
                                        'rgba(70, 255, 204, 1)',
                                        'rgba(213, 255, 115, 1)',
                                        'rgba(250, 202, 195 , 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                legend: {
                                display: false,
                                },
                                scales: {
                                xAxes: [{
                                    gridLines: {
                                        drawOnChartArea: false
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        drawOnChartArea: false
                                    },
                                    ticks:{
                                        min:0,
                                        max:50
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Jml Dokumen'
                                    }
                                }]
                                }
                            },
                        });
                    </script>


                </div>
                <!-- end of card Body-->
                

                
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card h-100 shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-dark">
                <h6 class="m-0 text-warning">Jumlah Dokumen Berdasarkan Type</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                        <canvas id="typeDocChart"></canvas>         
    
                    <!-- //grafik jumlah wo -->
                    <script>
                        var ctx = document.getElementById('typeDocChart').getContext('2d');
                        var jenisChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: <?= json_encode($typedoc); ?>,
                                datasets: [{
                                    label: 'Jenis WO',
                                    data: <?= json_encode($totaltype); ?>,
                                    backgroundColor: [
                                        'rgba(255, 92, 70, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(29, 219, 72, 1)',
                                        'rgba(70, 255, 204, 1)',
                                        'rgba(213, 255, 115, 1)',
                                        'rgba(250, 202, 195 , 1)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 92, 70, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(29, 219, 72, 1)',
                                        'rgba(70, 255, 204, 1)',
                                        'rgba(213, 255, 115, 1)',
                                        'rgba(250, 202, 195 , 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                legend: {
                                    position: 'bottom',
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            },
                                            display: false
                                        }]
                                    }
                                }
                        });
                    </script>


                </div>
                <!-- end of card Body-->
                

                
            </div>
        </div>

    </div>

    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

