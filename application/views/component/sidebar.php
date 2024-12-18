<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?=base_url('dashboard')?>">
                <img alt="image" src="<?=base_url('assets/img/logo.png')?>" style="width: 50px;" />
                <span>PT. SLI</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?=base_url('dashboard')?>">SLI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="<?=$this->uri->segment(1) === 'dashboard' ? "active" : ""?>"><a class="nav-link"
                    href="<?=base_url('dashboard')?>"><i class="fab fa-cloudsmith"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Menu</li>
            <li class="<?=$this->uri->segment(1) === 'surat_keluar' ? "active" : ""?>"><a class="nav-link"
                    href="<?=base_url('surat_keluar')?>"><i class="fas fa-file-export"></i></i></i> <span>Surat
                        Keluar</span></a>
            </li>
            <li class="<?=$this->uri->segment(1) === 'surat_masuk' ? "active" : ""?>"><a class="nav-link"
                    href="<?=base_url('surat_masuk')?>"><i class="fas fa-file-import"></i></i></i> <span>Surat
                        Masuk</span></a>
            </li>
            <li class="<?=$this->uri->segment(1) === 'laporan' ? "active" : ""?>"><a class="nav-link"
                    href="<?=base_url('laporan')?>"><i
                        class="fas fa-file-signature"></i></i></i><span>Laporan</span></a>
            </li>
            <li class="<?=$this->uri->segment(1) === 'kelola_user' ? "active" : ""?>"><a class="nav-link"
                    href="<?=base_url('kelola_user')?>"><i class="fas fa-users-cog"></i></i></i><span>Kelola
                        User</span></a>
            </li>


        </ul>


    </aside>
</div>