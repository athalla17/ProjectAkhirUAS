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
            <div class="col-md-12">
                <div class="ibox-content">
                    <h3 class="text-center">Daftar Akun Supplier</h3>
                    <p style="text-align: center;">Silahkan masukkkan identitas anda, lalu pilih tombol <code>Daftar Akun</code> untu melakukan pendaftaran akun Supplier anda. Jika sudah memiliki akun, akses akun anda <a href="<?php echo base_url('') ?>">disini</a></p>
                    <form class="m-t" role="form" action="<?php echo base_url('registers') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="Nama Lengkap Supplier" class="form-control form-control-sm" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Telepon</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="No. Telepon Supplier" class="form-control form-control-sm" name="telepon" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Asal</label>
                            <div class="col-lg-5">
                                <input type="text" placeholder="Kota Asal" class="form-control form-control-sm" name="kota" list="daftarkota" required>
                                <datalist id="daftarkota">
                                    <?php foreach ($kota as $k) {?>
                                        <option><?php echo $k['kota'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Provinsi" class="form-control form-control-sm" name="provinsi" list="daftarprovinsi" required>
                                <datalist id="daftarprovinsi">
                                    <?php foreach ($provinsi as $p) {?>
                                        <option><?php echo $p['provinsi'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>                    
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Alamat</label>
                            <div class="col-lg-9">
                                <textarea placeholder="Alamat Lengkap Supplier" class="form-control form-control-sm" name="alamat" rows="3" style="resize: none;height: 90px;" required></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3 class="text-center">Berkas Pendaftaran <code>Wajib Dilengkapi!</code></h3>
                        <strong>Gambar / Foto (format *.jpg)</strong><br><br>                        
                        <div class="form-group row"><label class="col-lg-3 col-form-label">KTP Direktur & Komanditer</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="ktp" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Kartu NPWP Direktur</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="npwp2" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Kartu NPWP CV</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="npwp1" accept="image/*" required>
                            </div>
                        </div>
                        <hr>
                        <strong>Scan Dokumen (format *.pdf)</strong><br><br>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Profil CV</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="cv" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Akta Pendirian CV</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="akta" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Suket Domisili CV</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="skdom" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Suket Terdaftar</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="skreg" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Suket Rekening</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="skrek" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">SIUP Menengah</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="siupm" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Surat Pengukuhan Pengusaha Kena Pajak</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="sppajak" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-3 col-form-label">Laporan Pajak</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="pajak" accept="application/pdf" required>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary block full-width m-b">Daftar Akun</button>
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