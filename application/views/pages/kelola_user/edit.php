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
                        <h1>Edit User</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Foto</h4>
                                    </div>
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="mt-3">
                                            <img id="imagePreview"
                                                src="<?=base_url('assets/upload/user/') . $user_detail->foto_profil?>"
                                                alt="Pratinjau Gambar" class="img-fluid" style="max-height: 700px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Form tambah user</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?=base_url('kelola_user/edit_process/') . $user->id?>"
                                            method="post" enctype="multipart/form-data"
                                            onsubmit="return validatePassword()">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama_lengkap"
                                                    id="nama_lengkap" placeholder="Nama Lengkap" required
                                                    value="<?=$user_detail->nama_lengkap?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_telepon">Nomor Telepon</label>
                                                <input type="text" class="form-control" name="nomor_telepon"
                                                    id="nomor_telepon" placeholder="Nomor Telepon" required
                                                    value="<?=$user_detail->nomor_telepon?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tanggal_lahir"
                                                    id="tanggal_lahir" placeholder="Tanggal Lahir" required
                                                    value="<?=$user_detail->tanggal_lahir?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Foto</label>
                                                <input class="form-control" type="file" name="image" id="image"
                                                    onchange="previewImage(event)">
                                                <input type="hidden" name="old_image"
                                                    value="<?=$user_detail->foto_profil?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-control" name="role" id="role" required>
                                                    <option disabled selected>Pilih Role</option>
                                                    <option value="admin"
                                                        <?=isset($user->role) && $user->role == 'admin' ? 'selected' : ''?>>
                                                        Admin</option>
                                                    <option value="superadmin"
                                                        <?=isset($user->role) && $user->role == 'superadmin' ? 'selected' : ''?>>
                                                        Super Admin</option>
                                                </select>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Form ubah password</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?=base_url('kelola_user/change_password/') . $user->id?>"
                                            method="post" enctype="multipart/form-data"
                                            onsubmit="return validatePassword()">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username" id="username"
                                                    placeholder="Username" required readonly
                                                    value="<?=$user->username?>">
                                                <div id="username-error" class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="konfirmasi_password">Konfirmasi Password</label>
                                                <input type="password" class="form-control" name="konfirmasi_password"
                                                    id="konfirmasi_password" placeholder="Konfirmasi Password" required>
                                                <div id="password-error" class="invalid-feedback"></div>
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

    function checkUsernameAvailability() {
        const username = document.getElementById('username').value;

        // Kirim data ke server menggunakan AJAX
        $.ajax({
                url: " <?=base_url('kelola_user/check_username')?>", // URL ke fungsi controller method: "POST" , data: {
                username: username
            }, dataType: "json", success: function(response) {
                if (response.exists) {
                    $('#username').addClass('is-invalid');
                    $('#username-error').html('Username sudah digunakan.');
                } else {
                    $('#username').removeClass('is-invalid');
                    $('#username-error').html('');
                }
            }
        });
    } // Panggil fungsi saat
    input berubah $('#username').on('input', function() {
        checkUsernameAvailability();
    });

    function validatePassword() {
        const
            password = document.getElementById('password').value;
        const
            confirmPassword = document.getElementById('konfirmasi_password').value;
        const errorDiv = document.getElementById('password-error');
        if (password !== confirmPassword) { // Tampilkan pesan error
            errorDiv.innerText = "Password dan Konfirmasi Password tidak cocok!";
            document.getElementById('konfirmasi_password').classList.add('is-invalid');
            return false; // Mencegah form submit } else { // Bersihkan error
            jika cocok errorDiv.innerText = "";
            document.getElementById('konfirmasi_password').classList.remove('is-invalid');
            return true; // Submit form jika valid } }
    </script>
</body>