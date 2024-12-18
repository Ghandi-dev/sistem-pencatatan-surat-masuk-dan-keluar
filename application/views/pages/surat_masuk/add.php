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
                        <h1>Tambah Surat Masuk</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pilih Surat</h4>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <select class="form-control" id="suratSelect" onchange="updateFields()">
                                                    <option value="" selected disabled>Pilih Surat</option>
                                                    <?php foreach ($surat_keluar as $surat): ?>
                                                    <option value="<?=$surat->id?>"
                                                        data-surat='<?=json_encode($surat)?>'>
                                                        <?=$surat->no_manifest?>|<?=$surat->perusahaan_penghasil?>|<?=$surat->tgl?>
                                                    </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Foto Surat</h4>
                                    </div>
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="mt-3">
                                            <img id="imagePreview"
                                                src="https://via.placeholder.com/500x700?text=No+Image"
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
                                                            id="no_manifest" placeholder="No Manifest" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="perusahaan_penghasil">Perusahaan Penghasil</label>
                                                        <input type="text" class="form-control"
                                                            name="perusahaan_penghasil" id="perusahaan_penghasil"
                                                            placeholder="Perusahaan Penghasil" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="transporter">Transporter</label>
                                                        <input type="text" class="form-control" name="transporter"
                                                            id="transporter" placeholder="Transporter" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_supir">Nama Supir</label>
                                                        <input type="text" class="form-control" name="nama_supir"
                                                            id="nama_supir" placeholder="Nama Supir" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_surat">Tanggal Surat</label>
                                                <input type="date" class="form-control" name="tanggal_surat"
                                                    id="tanggal_surat" placeholder="Tanggal Surat" readonly>
                                            </div>
                                        </form>
                                        <form action="<?=base_url('surat_masuk/add_process')?>" method="post"
                                            enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="deskripsi_barang">Deskripsi Barang</label>
                                                <input type="text" class="form-control" name="deskripsi_barang"
                                                    id="deskripsi_barang" placeholder="Deskripsi Barang" required>
                                                <input type="hidden" name="id_surat" id="id_surat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">Qty</label>
                                                <input type="text" class="form-control" name="qty" id="qty"
                                                    placeholder="Qty" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_pol">Nomor Polisi</label>
                                                <input type="text" class="form-control" name="no_pol" id="no_pol"
                                                    placeholder="Nomor Polisi" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_kembali">Tanggal Kembali</label>
                                                <input type="date" class="form-control" name="tgl_kembali"
                                                    id="tgl_kembali" placeholder="Tanggal Kembali" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" class="form-control" id="keterangan"
                                                    placeholder="Keterangan"></textarea required>
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
    function updateFields() {
        const selectElement = document.getElementById('suratSelect');
        const selectedOption = selectElement.options[selectElement.selectedIndex];

        // Ambil data JSON dari atribut data-surat
        const suratData = selectedOption.getAttribute('data-surat');
        if (suratData) {
            const surat = JSON.parse(suratData); // Parse JSON ke objek

            // Isi input dengan data dari objek
            document.getElementById('no_manifest').value = surat.no_manifest || '';
            document.getElementById('perusahaan_penghasil').value = surat.perusahaan_penghasil || '';
            document.getElementById('tanggal_surat').value = surat.tgl || '';
            document.getElementById('transporter').value = surat.transporter || '';
            document.getElementById('nama_supir').value = surat.nama_supir || '';
            document.getElementById('imagePreview').src = surat.image ?
                '<?php echo base_url('assets/upload/surat_keluar/'); ?>' + surat.image :
                'https://via.placeholder.com/500x700?text=No+Image';
            document.getElementById('id_surat').value = surat.id;

        } else {
            // Kosongkan input jika tidak ada data
            document.getElementById('no_manifest').value = '';
            document.getElementById('perusahaan_penghasil').value = '';
            document.getElementById('tanggal_surat').value = '';
            document.getElementById('transporter').value = '';
            document.getElementById('nama_supir').value = '';
            document.getElementById('imagePreview').src = 'https://via.placeholder.com/500x700?text=No+Image';
        }
    }
    </script>
</body>