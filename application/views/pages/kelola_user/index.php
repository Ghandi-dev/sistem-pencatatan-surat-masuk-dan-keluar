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
                        <h1>Kelola User</h1>
                        <div class="section-header-button">
                            <a href="<?=base_url('kelola_user/add')?>" class="btn btn-primary"><span
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
                                                        <th>Username</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Role</th>
                                                        <th>No Telepon</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
foreach ($users as $row): ?>
                                                    <tr>
                                                        <td><?=$no++;?></td>
                                                        <td><?=$row->username;?></td>
                                                        <td><?=$row->nama_lengkap;?></td>
                                                        <td><?=$row->role;?></td>
                                                        <td><?=$row->nomor_telepon;?></td>
                                                        <td>
                                                            <a href="<?=base_url('kelola_user/edit/' . $row->user_id)?>"
                                                                class="btn btn-sm btn-warning">
                                                                <span class="fa fa-edit"></span> Edit
                                                            </a>
                                                            <a href="<?=base_url('kelola_user/delete/' . $row->user_id)?>"
                                                                class="btn btn-sm btn-danger btn-hapus">
                                                                <span class="fa fa-trash"></span> Hapus
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