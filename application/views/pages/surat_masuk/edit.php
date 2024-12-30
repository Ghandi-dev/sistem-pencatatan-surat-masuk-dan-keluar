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
                        <h1>Edit Surat Masuk</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Foto Surat</h4>
                                    </div>
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="mt-3">
                                            <img id="imagePreview"
                                                src="<?=base_url('assets/upload/surat_keluar/') . $surat_masuk->image?>"
                                                alt="Pratinjau Gambar" class="img-fluid" style="max-height: 700px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Form Surat Keluar</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="no_manifest">No Manifest</label>
                                                        <input type="text" class="form-control" name="no_manifest"
                                                            id="no_manifest" placeholder="No Manifest" readonly
                                                            value="<?=$surat_masuk->no_manifest?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="perusahaan_penghasil">Perusahaan Penghasil</label>
                                                        <input type="text" class="form-control"
                                                            name="perusahaan_penghasil" id="perusahaan_penghasil"
                                                            placeholder="Perusahaan Penghasil" readonly
                                                            value="<?=$surat_masuk->perusahaan_penghasil?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="transporter">Transporter</label>
                                                        <input type="text" class="form-control" name="transporter"
                                                            id="transporter" placeholder="Transporter" readonly
                                                            value="<?=$surat_masuk->transporter?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_supir">Nama Supir</label>
                                                        <input type="text" class="form-control" name="nama_supir"
                                                            id="nama_supir" placeholder="Nama Supir" readonly
                                                            value="<?=$surat_masuk->nama_supir?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_surat">Tanggal Surat</label>
                                                <input type="date" class="form-control" name="tanggal_surat"
                                                    id="tanggal_surat" placeholder="Tanggal Surat" readonly
                                                    value="<?=$surat_masuk->tgl?>">
                                            </div>
                                        </form>
                                        <form action="<?=base_url('surat_masuk/edit_process/') . $surat_masuk->id?>"
                                            method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="deskripsi_barang">Deskripsi Barang</label>
                                                <input type="text" class="form-control" name="deskripsi_barang"
                                                    id="deskripsi_barang" placeholder="Deskripsi Barang" required
                                                    value="<?=$surat_masuk->deskripsi_barang?>">
                                                <input type="hidden" name="id_surat" id="id_surat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">Qty</label>
                                                <input type="text" class="form-control" name="qty" id="qty"
                                                    placeholder="Qty" required
                                                    value="<?=number_format($surat_masuk->qty, 0, ',', '.')?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" class="form-control" name="satuan" id="satuan"
                                                    placeholder="Satuan" required value="<?=$surat_masuk->satuan?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_pol">Nomor Polisi</label>
                                                <input type="text" class="form-control" name="no_pol" id="no_pol"
                                                    placeholder="Nomor Polisi" required
                                                    value="<?=$surat_masuk->no_pol?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_kembali">Tanggal Kembali</label>
                                                <input type="date" class="form-control" name="tgl_kembali"
                                                    id="tgl_kembali" placeholder="Tanggal Kembali" required
                                                    value="<?=$surat_masuk->tgl_kembali?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" class="form-control" id="keterangan"
                                                    placeholder="Keterangan"><?=$surat_masuk->keterangan?></textarea required>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
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
        const qtyInput = document.getElementById('qty');

        qtyInput.addEventListener('input', function (e) {
            // Remove any non-numeric characters
            let value = this.value.replace(/[^0-9]/g, '');

            // Format value to thousands
            value = new Intl.NumberFormat('id-ID').format(value);

            // Set formatted value back to input
            this.value = value;
        });
    </script>
</body>