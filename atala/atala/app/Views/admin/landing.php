<?php
$db = db_connect();
$akunbaru = $db->query("select * from pengguna where status = '' order by nama asc")->getResultArray();
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
                <h2>Statistik Data Sistem</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url('') ?>">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Aktif</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">Persentase Aktif</span>
                            <h5>Data Supplier</h5>
                        </div>
                        <?php
                        $a = count($db->query("select * from pengguna where level = 'supplier'")->getResultArray());
                        $b = count($db->query("select * from pengguna where level = 'supplier' and status = '1'")->getResultArray());
                        $persentase = 0;
                        if($a > 0 && $b > 0){
                            $persentase = ($b/$a)*100;
                        }
                        ?>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo number_format($a) ?></h1>
                            <div class="stat-percent font-bold text-success"><?php echo number_format($persentase,2)." %" ?> <i class="fa fa-bolt"></i></div>
                            <small>Jml. Data Supplier</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-info float-right">Persentase Aktif</span>
                            <h5>Proyek</h5>
                        </div>
                        <?php
                        $a = count($db->query("select * from proyek")->getResultArray());
                        $b = count($db->query("select * from proyek where status = '1'")->getResultArray());
                        $persentase = 0;
                        if($a > 0 && $b > 0){
                            $persentase = ($b/$a)*100;
                        }
                        ?>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo number_format($a) ?></h1>
                            <div class="stat-percent font-bold text-info"><?php echo number_format($persentase,2)." %" ?> <i class="fa fa-level-up"></i></div>
                            <small>Jml. Proyek</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" title="Persentase Bobot merupakan persentase dari total kriteria yang digunakan rata-rata proyek">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-primary float-right">Persentase</span>
                            <h5>Kriteria</h5>
                        </div>
                        <?php
                        $a = count($db->query("select * from kriteria")->getResultArray());
                        $b = count($db->query("select * from skema")->getResultArray());
                        $c = count($db->query("select * from proyek")->getResultArray());
                        $persentase = 0;
                        if($a > 0 && $b > 0){
                            $persentase = ($b/($a*$c))*100;
                        }
                        ?>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo number_format($a)." Kriteria" ?></h1>
                            <div class="stat-percent font-bold text-navy"><?php echo number_format($persentase,2)." %" ?> <i class="fa fa-pie-chart"></i></div>
                            <small>Pembobotan Proyek</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-danger float-right">Persentase</span>
                            <h5>Aktifitas Supplier</h5>
                        </div>
                        <?php
                        $a = count($db->query("select * from proyek")->getResultArray());
                        $b = count($db->query("select * from register")->getResultArray());
                        $c = count($db->query("select * from pengguna where level = 'supplier'")->getResultArray());
                        $persentase = 0;
                        if($a > 0 && $b > 0){
                            $persentase = ($b/($a*$c))*100;
                        }
                        ?>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo number_format($a)." Proyek"?></h1>
                            <div class="stat-percent font-bold text-danger"><?php echo number_format($persentase,2)." %" ?> <i class="fa fa-file"></i></div>
                            <small>Peminatan Proyek</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(count($akunbaru) > 0){ ?>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <h3>Akun Supplier Baru</h3>
                                <p style="text-align: justify;">Daftar akun supplier dibawah merupakan data supplier yang mendaftarkan diri secara mandiri melalui sistem dan membutuhkan verifikasi Administrator untuk dapat mengakses sistem (sebagai pengguna). Pilih <code>Terima</code> untuk memverifikasi akun dan mengaktifkan akun. Pilih <code>Tolak</code> untuk menghapus dan menolak data</p>
                                <hr>
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
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($akunbaru as $d) {?>
                                                <tr>
                                                    <td><?php echo $d['kodepengguna'] ?></td>
                                                    <td><?php echo $d['nama'] ?></td>
                                                    <td><?php echo $d['kota'] ?></td>
                                                    <td><?php echo $d['provinsi'] ?></td>
                                                    <td><?php echo $d['alamat'] ?></td>
                                                    <td><?php echo $d['telepon'] ?></td>
                                                    <td><?php echo $d['username'] ?></td>
                                                    <td align="center">
                                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#detail<?php echo $d['kodepengguna'] ?>">Detail Data</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php echo view('admin/bagianfooter') ?>
    </div>
</div>
<?php echo view('admin/bagianscript') ?>
</body>
<?php foreach ($akunbaru as $d) {?>
    <div class="modal inmodal" id="detail<?php echo $d['kodepengguna'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong style="font-size: 13pt;">Detail Data</strong><br>
                    input perubahan detail data seusai dengan inputan form, lalu pilih <strong>Simpan Data</strong>
                    <br><br>
                    <table class="table" style="border: none;">
                        <tr>
                            <th width="27%" style="text-align: left;">Kode</th>
                            <td style="text-align: left;">: <?php echo $d['kodepengguna'] ?></td>
                        </tr>
                        <tr>
                            <th width="27%" style="text-align: left;">Nama</th>
                            <td style="text-align: left;">: <?php echo $d['nama'] ?></td>
                        </tr>
                        <tr>
                            <th width="27%" style="text-align: left;">Alamat</th>
                            <td style="text-align: left;">: <?php echo $d['alamat'] ?></td>
                        </tr>
                        <tr>
                            <th width="27%" style="text-align: left;">Telepon</th>
                            <td style="text-align: left;">: <?php echo $d['telepon'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-header">
                    <h3>Berkas Pendukung</h3><br>
                    <table class="table" style="border: none;line-height: 0;">
                        <?php
                        for ($i=0; $i < count($file); $i++) {
                            $x = $db->query("select ".$file[$i]." from berkas where kodepengguna = '".$d['kodepengguna']."'")->getRowArray()[$file[$i]];
                            ?>
                            <tr>
                                <th width="50%" style="text-align: left;"><?php echo $berkas[$i] ?></th>
                                <td style="text-align: left;">: <a href="<?php echo base_url('/assets/berkas/'.$x) ?>" target="blank">Lihat</a> | <a href="<?php echo base_url('/assets/berkas/'.$x) ?>" download>Download</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url('terima/'.$d['kodepengguna']) ?>" class="btn btn-success btn-sm">Terima</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="<?php echo base_url('tolak/'.$d['kodepengguna']) ?>" class="btn btn-danger btn-sm">Tolak</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</html>