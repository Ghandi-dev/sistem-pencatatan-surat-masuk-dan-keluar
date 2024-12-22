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
                        <h1>Laporan</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="row px-3 d-flex align-items-center">
                                            <div class="col-sm-12 col-md-5 px-0 mt-2">
                                                <div class="form-group">
                                                    <label>
                                                        <h5>Rentang Waktu</h5>
                                                    </label>
                                                    <div class="input-group" style=" max-width: 360px;">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control daterange-cus">
                                                        <button id="cetakLaporanBtn" type="button"
                                                            class="btn btn-sm btn-primary ml-2">Cetak
                                                            Laporan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="tableReport">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>No Manifest</th>
                                                            <th>Transporter</th>
                                                            <th>Perusahaan Penghasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
    $('.daterange-cus').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        drops: 'down',
        opens: 'right',
    });

    let table = $("#tableReport").DataTable({
        paging: false, // Menonaktifkan pagination
        searching: false, // Menonaktifkan pencarian
        ordering: false, // Menonaktifkan pengurutan
        info: false, // Menonaktifkan informasi jumlah data
        processing: true,
        serverSide: true,
        ajax: {
            url: 'laporan/data',
            type: 'POST',
            data: function(d) {
                d.date_range = $('.daterange-cus').val()
            }
        },
        columns: [{
                data: 'no'
            },
            {
                data: 'tgl'
            },
            {
                data: 'no_manifest'
            },
            {
                data: 'transporter'
            },
            {
                data: 'perusahaan_penghasil'
            },
        ]
    });

    $('.daterange-cus').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        table.ajax.reload(); // Reload DataTable when date is selected
    });

    $('.daterange-cus').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        table.ajax.reload(); // Reload DataTable when date is cleared
    });
    </script>
    <script>
    $('#cetakLaporanBtn').on('click', function() {
        var dateRange = $('.daterange-cus').val(); // Ambil nilai daterange
        window.location.href = "<?=base_url('laporan/print')?>?date_range=" + dateRange;
    });
    </script>
</body>