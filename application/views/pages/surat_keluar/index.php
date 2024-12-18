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
                        <h1>Surat Keluar</h1>
                        <div class="section-header-button">
                            <a href="<?=base_url('surat_keluar/add')?>" class="btn btn-primary"><span
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
                                                        <th>Tanggal</th>
                                                        <th>No Manifest</th>
                                                        <th>Transporter</th>
                                                        <th>Perusahaan Penghasil</th>
                                                        <th>Nama Supir</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
foreach ($surat_keluar as $row): ?>
                                                    <tr>
                                                        <td><?=$no++;?></td>
                                                        <td><?=$row->tgl;?></td>
                                                        <td><?=$row->no_manifest;?></td>
                                                        <td><?=$row->transporter;?></td>
                                                        <td><?=$row->perusahaan_penghasil;?></td>
                                                        <td><?=$row->nama_supir;?></td>
                                                        <td>
                                                            <a href="<?=base_url('surat_keluar/edit/' . $row->id)?>"
                                                                class="btn btn-sm btn-warning">
                                                                <span class="fa fa-edit"></span> Edit
                                                            </a>
                                                            <a href="<?=base_url('surat_keluar/delete/' . $row->id)?>"
                                                                class="btn btn-sm btn-danger btn-hapus">
                                                                <span class="fa fa-trash"></span> Del
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