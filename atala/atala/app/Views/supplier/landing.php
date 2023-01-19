<?php
$db = db_connect();
$pengguna = $db->query("select * from pengguna where kodepengguna = '".session()->get('supplier')."'")->getRowArray();
$proyek = $db->query("select register.*, proyek.* from register join proyek on register.kodeproyek = proyek.kodeproyek where register.kodepengguna = '".session()->get('supplier')."' order by register.waktu desc limit 5")->getResultArray();
$cek = $db->query("select * from berkas where kodepengguna = '".session()->get('supplier')."'")->getResultArray();
?>
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
                <h2>Selamat Datang <?php echo $pengguna['nama'] ?></h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><strong>Dashboard</strong></li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <?php if(count($cek) > 0){ ?>
                <div class="row border-bottom white-bg dashboard-header">
                    <div class="col-md-4">
                        <small>Proyek diambil terakhir</small>
                        <ul class="list-group clear-list m-t">
                            <?php
                            $x = 1;
                            foreach ($proyek as $p) {
                                ?>
                                <li class="list-group-item fist-item">
                                    <span class="float-right">
                                        <?php echo date('d/m/Y H:i:s', strtotime($p['waktu'])) ?>
                                    </span>
                                    <span class="label label-success"><?php echo $x ?></span> <?php echo $p['kodeproyek']." - ".$p['proyek'] ?>
                                </li>
                                <?php $x++;
                            } ?>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $p = $db->query("select count(*) as jumlah from proyek")->getRowArray()['jumlah'];
                        $x = $db->query("select count(*) as jumlah from register where kodepengguna = '".session()->get('supplier')."'")->getRowArray()['jumlah'];
                        $persentase = 0;
                        if($p > 0 || $x > 0){
                            $persentase = ($x/$p)*100;
                        }
                        ?>
                        <div class="ibox ">
                            <div class="ibox-title">
                                <span class="label label-success float-right">Persentase</span>
                                <h5>Statistik Proyek</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($x)." / ".number_format($p) ?></h1>
                                <div class="stat-percent font-bold text-success"><?php echo number_format($persentase,2)."%" ?>&nbsp;<i class="fa fa-bar-chart"></i></div>
                                <small>Diambil / Jml. Proyek</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $p = $db->query("select count(*) as jumlah from proyek")->getRowArray()['jumlah'];
                        $x = 0;
                        $data = $db->query("select * from register where kodepengguna = '".session()->get('supplier')."'")->getResultArray();
                        foreach ($data as $d) {
                            $cek = $db->query("select * from hasil where kodeproyek = '".$d['kodeproyek']."' order by na desc limit 1")->getResultArray();
                            if(count($cek) > 0){
                                if($cek[0]['kodepengguna'] == session()->get('supplier')){
                                    $x++;
                                }
                            }
                        }
                        $persentase = 0;
                        if($p > 0 || $x > 0){
                            $persentase = ($x/$p)*100;
                        }
                        ?>
                        <div class="ibox ">
                            <div class="ibox-title">
                                <span class="label label-info float-right">Persentase</span>
                                <h5>Proyek Terdaftar</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($x)." / ".number_format($p) ?></h1>
                                <div class="stat-percent font-bold text-info"><?php echo number_format($persentase,2)."%" ?>&nbsp;<i class="fa fa-level-up"></i></div>
                                <small>Terdaftar / Jml. Proyek</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="row white-bg dashboard-header">
                    <div class="alert alert-danger col-md-12" role="alert">
                        <strong>Maaf, akses anda dibatasi!</strong> Lengkapi berkas pendukung terlebih dahulu untuk membuka akses anda
                    </div>
                    <form class="m-t col-md-12" role="form" action="<?php echo base_url('simpanberkas') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo session()->get('supplier') ?>">
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
                        <button type="submit" class="btn btn-primary m-b" style="float: right;">Simpan Berkas Pendukung</button>
                    </form>
                </div>
            <?php } ?>
            <?php echo view('supplier/bagianfooter') ?>
        </div>
    </div>
    <?php echo view('supplier/bagianscript') ?>
</body>
</html>