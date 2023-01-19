 <?php
 $db = db_connect();
 $pengguna = $db->query("select * from pengguna where kodepengguna = '".session()->get('supplier')."'")->getRowArray();
 $cek = $db->query("select * from berkas where kodepengguna = '".session()->get('supplier')."'")->getResultArray();
 ?>
 <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo base_url('/assets/user/#') ?>">
                        <span class="block m-t-xs font-bold"><?php echo $pengguna['nama'] ?></span>
                        <span class="text-muted text-xs block">Supplier <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="<?php echo base_url('supplier/profil') ?>">Akun Profil</a></li>
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
            <?php if(count($cek) > 0){ ?>
                <li>
                    <a href="<?php echo base_url('register') ?>"><i class="fa fa-pie-chart"></i> <span class="nav-label">Data Proyek</span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('penilaian') ?>"><i class="fa fa-flask"></i> <span class="nav-label">Penilaian Proyek</span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('result') ?>"><i class="fa fa-file"></i> <span class="nav-label">Hasil Penilaian</span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>