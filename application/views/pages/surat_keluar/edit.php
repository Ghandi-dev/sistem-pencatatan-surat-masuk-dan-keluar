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
                        <h1>Edit Surat Keluar</h1>
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
                                                src="<?=base_url('assets/upload/surat_keluar/' . $surat_keluar->image)?>"
                                                alt="Pratinjau Gambar" class="img-fluid" style="max-height: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Form Edit Surat Keluar</h4>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="<?=base_url('surat_keluar/edit_process' . '/' . $surat_keluar->id)?>"
                                            method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="no_manifest">No Manifest</label>
                                                <input type="text" class="form-control" name="no_manifest"
                                                    id="no_manifest" placeholder="No Manifest"
                                                    value="<?=$surat_keluar->no_manifest?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="perusahaan_penghasil">Perusahaan Penghasil</label>
                                                <input type="text" class="form-control" name="perusahaan_penghasil"
                                                    id="perusahaan_penghasil" placeholder="Perusahaan Penghasil"
                                                    value="<?=$surat_keluar->perusahaan_penghasil?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="transporter">Transporter</label>
                                                <input type="text" class="form-control" name="transporter"
                                                    id="transporter" placeholder="Transporter"
                                                    value="<?=$surat_keluar->transporter?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_supir">Nama Supir</label>
                                                <input type="text" class="form-control" name="nama_supir"
                                                    id="nama_supir" placeholder="Nama Supir"
                                                    value="<?=$surat_keluar->nama_supir?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_surat">Tanggal Surat</label>
                                                <input type="date" class="form-control" name="tanggal_surat"
                                                    id="tanggal_surat" placeholder="Tanggal Surat"
                                                    value="<?=$surat_keluar->tgl?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Foto Surat</label>
                                                <input class="form-control" type="file" name="image" id="image"
                                                    onchange="previewImage(event)">
                                                <input type="hidden" name="old_image" value="<?=$surat_keluar->image?>">
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
    // Fungsi untuk pratinjau gambar
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        // Pastikan ada file yang diunggah
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Set src dari elemen img
                preview.style.display = 'block'; // Tampilkan pratinjau
            };

            reader.readAsDataURL(input.files[0]); // Membaca file sebagai URL Data
        } else {
            preview.style.display = 'none'; // Sembunyikan pratinjau jika file dihapus
        }
    }
    </script>
</body>