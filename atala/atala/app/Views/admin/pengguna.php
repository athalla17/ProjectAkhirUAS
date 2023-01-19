<?php
$db = db_connect();
$file = ['ktp','npwp1','npwp2','cv','akta','skdom','skreg','skrek','siupm','pajak','sppajak'];
$berkas = ['KTP Direktur & Komanditer','Kartu NPWP Direktur','Kartu NPWP CV','Profil CV','Akta Pendirian CV','Suket Domisili CV','Suket Terdaftar','Suket Rekening','SIUP Menengah','Surat Pengukuhan Pengusaha Kena Pajak','Laporan Pajak'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo view('admin/bagianhead') ?>
</head>
<body class="">
    <div id="wrapper">
        <?php echo view('admin/bagiannavigasi') ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Data Supplier</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Data Supplier</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#baru">Tambah Data Baru</button>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kota</th>
                                                <th>Provinsi</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Username</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data as $d) {
                                                if($d['status'] != ''){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $d['kodepengguna'] ?></td>
                                                        <td><?php echo $d['nama'] ?></td>
                                                        <td><?php echo $d['kota'] ?></td>
                                                        <td><?php echo $d['provinsi'] ?></td>
                                                        <td><?php echo $d['alamat'] ?></td>
                                                        <td><?php echo $d['telepon'] ?></td>
                                                        <td><?php echo $d['username'] ?></td>
                                                        <td><?php
                                                        if($d['status'] == '1'){
                                                            echo "Aktif";
                                                        }else{
                                                            echo "Nonaktif";
                                                        }
                                                        ?></td>
                                                        <td align="center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#detail<?php echo $d['kodepengguna'] ?>">Detail Data</button></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('admin/bagianfooter') ?>
        </div>
    </div>
    <?php echo view('admin/bagianscript') ?>
</body>
<div class="modal inmodal" id="baru" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong style="font-size: 13pt;">Tambah Data Baru</strong><br>
                input detail data seusai dengan inputan form, lalu pilih <strong>Simpan Data</strong>
            </div>
            <form action="<?php echo base_url('pengguna/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Nama</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Nama Lengkap Supplier" class="form-control form-control-sm" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Telepon</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="No. Telepon Supplier" class="form-control form-control-sm" name="telepon" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Asal</label>
                        <div class="col-lg-6">
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
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Alamat</label>
                        <div class="col-lg-10">
                            <textarea placeholder="Alamat Lengkap Supplier" class="form-control form-control-sm" name="alamat" rows="3" style="resize: none;height: 90px;" required></textarea>
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
<?php
foreach ($data as $d) {
    $cek = $db->query("select * from berkas where kodepengguna = '".$d['kodepengguna']."'")->getResultArray();
    ?>
    <div class="modal inmodal" id="detail<?php echo $d['kodepengguna'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong style="font-size: 13pt;">Detail Data</strong><br>
                    input perubahan detail data seusai dengan inputan form, lalu pilih <strong>Simpan Data</strong>
                </div>
                <form action="<?php echo base_url('pengguna/ubah') ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $d['kodepengguna'] ?>">
                    <div class="modal-body">
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Nama</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Nama Lengkap Supplier" class="form-control form-control-sm" name="nama" required value="<?php echo $d['nama'] ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Telepon</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="No. Telepon Supplier" class="form-control form-control-sm" name="telepon" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required value="<?php echo $d['telepon'] ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Asal</label>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Kota Asal" class="form-control form-control-sm" name="kota" list="daftarkota" required value="<?php echo $d['kota'] ?>">
                                <datalist id="daftarkota">
                                    <?php foreach ($kota as $k) {?>
                                        <option><?php echo $k['kota'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Provinsi" class="form-control form-control-sm" name="provinsi" list="daftarprovinsi" required value="<?php echo $d['provinsi'] ?>">
                                <datalist id="daftarprovinsi">
                                    <?php foreach ($provinsi as $p) {?>
                                        <option><?php echo $p['provinsi'] ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>                    
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Alamat</label>
                            <div class="col-lg-10">
                                <textarea placeholder="Alamat Lengkap Supplier" class="form-control form-control-sm" name="alamat" rows="3" style="resize: none;height: 90px;" required><?php echo $d['alamat'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Status</label>
                            <div class="col-lg-10">
                                <select class="form-control form-control-sm" name="status" required>
                                    <option <?php if($d['status'] == '1'){echo "selected";} ?> value="1">Aktif</option>
                                    <option <?php if($d['status'] == '0'){echo "selected";} ?> value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="modal-header">
                        <h3>Berkas Pendukung</h3><br>
                        <table class="table" style="border: none;line-height: 0;">
                            <?php
                            for ($i=0; $i < count($file); $i++) {
                                $x = "............";
                                $cek = $db->query("select * from berkas where kodepengguna = '".$d['kodepengguna']."'")->getResultArray();
                                if(count($cek) > 0){
                                    $x = $db->query("select ".$file[$i]." from berkas where kodepengguna = '".$d['kodepengguna']."'")->getRowArray()[$file[$i]];    
                                }
                                ?>
                                <tr>
                                    <th width="50%" style="text-align: left;"><?php echo $berkas[$i] ?></th>
                                    <td style="text-align: left;">:
                                        <?php if(count($cek) > 0){ ?>
                                            <a href="<?php echo base_url('/assets/berkas/'.$x) ?>" target="blank">Lihat</a> | <a href="<?php echo base_url('/assets/berkas/'.$x) ?>" download>Download</a>
                                            <?php
                                        }else{
                                            echo $x;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</html>