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
                        <h1>Surat Masuk</h1>
                        <div class="section-header-button">
                            <a href="<?=base_url('surat_masuk/add')?>" class="btn btn-primary"><span
                                    class="fa fa-plus"></span>
                                Tambah</a>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Perushaan Penghasil</th>
                                                        <th>Tanggal Kembali</th>
                                                        <th>Deskripsi Barang</th>
                                                        <th>Qty</th>
                                                        <th>Satuan</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
foreach ($surat_masuk as $row): ?>
                                                    <tr>
                                                        <td><?=$no++;?></td>
                                                        <td><?=$row->perusahaan_penghasil;?></td>
                                                        <td><?=$row->tgl_kembali;?></td>
                                                        <td><?=$row->deskripsi_barang;?></td>
                                                        <td><?=number_format($row->qty, 0, ',', '.');?>
                                                        </td>
                                                        <td><?=$row->satuan;?></td>
                                                        <td><?=$row->keterangan;?></td>
                                                        <td>
                                                            <a href="<?=base_url('surat_masuk/edit/' . $row->id)?>"
                                                                class="btn btn-sm btn-warning">
                                                                <span class="fa fa-edit"></span> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
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
</body>