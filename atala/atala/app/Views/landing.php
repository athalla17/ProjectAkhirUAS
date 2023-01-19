<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Supplier Material</title>
    <link href="<?php echo base_url('/assets/user/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/user/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/user/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/user/css/style.css') ?>" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">SPK Supplier Material</h2>
                <p style="text-align: justify;">
                    Sistem Pendukung Keputusan (SPK) Supplier Material merupakan sistem yang digunakan oleh Unit Pelaksana Teknis Daerah Pemeliharaan Pengawasan Pekerjaan Umum (UPTD P2PU) Pemerintah Wilayah Bandar Kabupaten Batang sebagai wadah atau sarana dalam proses pertimbangan dan referensi dalam penentuan Supplier yang layak atau direkomendasikan untuk menangani proyek yang ditangani.
                    <br>
                    <small>
                        <code>PENTING!!!</code><br>
                        Akses masuk hanya untuk Supplier yang diberikan atau dikelola oleh Administrator sistem! Anda dapat mendaftarkan diri sebagai supplier <a href="<?php echo base_url('daftar') ?>">disini</a>
                    </small>
                </p>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="<?php echo base_url('login') ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username Akses" name="username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password Akses" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Log In</button>
                        <?php if(session()->getFlashData('gagal')){ ?>
                            <p class="text-muted text-center">
                                <small style="color:red;"><?php echo session()->getFlashData('gagal'); ?></small>
                            </p>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                UPTD P2PU Wilayah Bandar
            </div>
            <div class="col-md-6 text-right">
                <small>© 2022</small>
            </div>
        </div>
    </div>
</body>
</html>