<?php $this->load->view('component/header');?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php $this->load->view('component/navbar');?>
            <?php $this->load->view('component/sidebar');?>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-file-export"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total surat keluar</h4>
                                        </div>
                                        <div class="card-body">
                                            <?=$jumlah_surat_keluar?> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger">
                                        <i class="fas fa-file-import"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total surat masuk</h4>
                                        </div>
                                        <div class="card-body">
                                            <?=$jumlah_surat_masuk?> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-warning">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Jumlah user</h4>
                                        </div>
                                        <div class="card-body">
                                            <?=$jumlah_user?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h4>Jumlah surat keluar 5 hari terakhir</h4>
                                    </div>
                                    <div class="card-body">
                                        <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                                            class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand"
                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div
                                                    style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                                </div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink"
                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                                                </div>
                                            </div>
                                        </div>
                                        <canvas id="surat-keluar"
                                            style="width: 633px; min-height: 400px; max-height: 500px; display: block; height: 316px;"
                                            width="506" height="252" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h4>Jumlah surat masuk 5 hari terakhir</h4>
                                    </div>
                                    <div class="card-body">
                                        <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                                            class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand"
                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div
                                                    style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                                </div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink"
                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                                                </div>
                                            </div>
                                        </div>
                                        <canvas id="surat-masuk"
                                            style="width: 633px; min-height: 400px; max-height: 500px; display: block; height: 316px;"
                                            width="506" height="252" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php $this->load->view('component/footer');?>
    </div>
    <?php $this->load->view('component/script');?>
    <script>
    // Ambil data dari PHP (pastikan formatnya sesuai dengan format JavaScript)
    var letterOutData = <?php echo json_encode($letter_out_last_5_days ?? []); ?>;
    var letterInData = <?php echo json_encode($letter_in_last_5_days ?? []); ?>;

    // Siapkan label dan data untuk chart
    var labelsOut = [];
    var dataOut = [];
    var labelsIn = [];
    var dataIn = [];

    // Loop untuk mengisi data chart dari hasil query
    letterOutData.forEach(function(letter) {
        labelsOut.push(letter.letter_date); // Tanggal
        dataOut.push(letter.letter_count); // Jumlah pesanan
    });

    letterInData.forEach(function(letter) {
        labelsIn.push(letter.letter_date); // Tanggal
        dataIn.push(letter.letter_count); // Jumlah pesanan
    });

    // Mendapatkan konteks chart
    var statistics_chartOut = document.getElementById("surat-keluar").getContext('2d');
    var statistics_chartIn = document.getElementById("surat-masuk").getContext('2d');

    // Membuat chart
    var surat_keluar = new Chart(statistics_chartOut, {
        type: 'line',
        data: {
            labels: labelsOut, // Tanggal yang didapat dari hasil query
            datasets: [{
                label: 'Jumlah',
                data: dataOut, // Jumlah pesanan per hari
                borderWidth: 5,
                borderColor: '#6777ef',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6777ef',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        stepSize: 50,
                        min: 0,
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }]
            },
        }
    });

    // Membuat chart
    var surat_masuk = new Chart(statistics_chartIn, {
        type: 'line',
        data: {
            labels: labelsIn, // Tanggal yang didapat dari hasil query
            datasets: [{
                label: 'Statistics',
                data: dataIn, // Jumlah pesanan per hari
                borderWidth: 5,
                borderColor: '#6777ef',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6777ef',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        stepSize: 50,
                        min: 0,
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }]
            },
        }
    });
    </script>
</body>