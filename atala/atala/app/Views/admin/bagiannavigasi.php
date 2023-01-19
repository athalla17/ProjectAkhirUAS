 <?php
 $db = db_connect();
 $pengguna = $db->query("select * from pengguna where kodepengguna = '".session()->get('admin')."'")->getRowArray();
 ?>
 <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo base_url('/assets/user/#') ?>">
                        <span class="block m-t-xs font-bold"><?php echo $pengguna['nama'] ?></span>
                        <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="<?php echo base_url('admin/profil') ?>">Akun Profil</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('logout') ?>">Log Out</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="<?php echo base_url('') ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Beranda</span></a>
            </li>
            <li>
                <a href="<?php echo base_url('pengguna') ?>"><i class="fa fa-users"></i> <span class="nav-label">Data Supplier</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Master Penilaian</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo base_url('kriteria') ?>">Data Kriteria</a></li>
                    <li><a href="<?php echo base_url('indikator') ?>">Data Indikator</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Master Proyek</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo base_url('proyek') ?>">Data Proyek</a></li>
                    <li><a href="<?php echo base_url('skema') ?>">Skema Penilaian</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">Penilaian Supplier</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo base_url('nilai') ?>">Data Nilai</a></li>
                    <li><a href="<?php echo base_url('proses') ?>">Proses Analisa</a></li>
                    <li><a href="<?php echo base_url('laporan') ?>">Laporan Hasil</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>