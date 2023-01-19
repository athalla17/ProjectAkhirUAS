<!DOCTYPE html>
<html>
<head>
    <?php echo view('supplier/bagianhead') ?>
</head>
<body class="">
    <div id="wrapper">
        <?php echo view('supplier/bagiannavigasi') ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Profil Akun</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Data Akun Profil</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <form action="<?php echo base_url('supplier/profil/ubah') ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group row"><label class="col-lg-2 col-form-label">Nama</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Nama Lengkap" class="form-control form-control-sm" name="nama" value="<?php echo $data['nama'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"><label class="col-lg-2 col-form-label">Telepon</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="No. Telepon" class="form-control form-control-sm" name="telepon" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $data['telepon'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"><label class="col-lg-2 col-form-label">Asal</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="Kota Asal" class="form-control form-control-sm" name="kota" list="daftarkota" value="<?php echo $data['kota'] ?>" required>
                                                <datalist id="daftarkota">
                                                    <?php foreach ($kota as $k) {?>
                                                        <option><?php echo $k['kota'] ?></option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" placeholder="Provinsi" class="form-control form-control-sm" name="provinsi" list="daftarprovinsi" value="<?php echo $data['provinsi'] ?>" required>
                                                <datalist id="daftarprovinsi">
                                                    <?php foreach ($provinsi as $p) {?>
                                                        <option><?php echo $p['provinsi'] ?></option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                        </div>                    
                                        <div class="form-group row"><label class="col-lg-2 col-form-label">Alamat</label>
                                            <div class="col-lg-10">
                                                <textarea placeholder="Alamat Lengkap" class="form-control form-control-sm" name="alamat" rows="3" style="resize: none;height: 90px;" required><?php echo $data['alamat'] ?></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row"><label class="col-lg-2 col-form-label">Username</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Username Akses Log In" class="form-control form-control-sm" name="username" value="<?php echo $data['username'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"><label class="col-lg-2 col-form-label">Password</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Password Akses Log In (kosongkan jika tidak diubah)" class="form-control form-control-sm" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('supplier/bagianfooter') ?>
        </div>
    </div>
    <?php echo view('supplier/bagianscript') ?>
</body>
</html>