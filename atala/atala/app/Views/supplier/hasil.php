<?php $db = db_connect(); ?>
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
                    <h2>Hasil Penilaian Proyek</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Hasil Analisa Penilaian Proyek</strong>
                        </li>
                    </ol>
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
                                                <th>Proyek</th>
                                                <th>Deskripsi</th>
                                                <th>Biaya</th>
                                                <th>Status</th>
                                                <th>Supplier</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data as $d) {
                                                $supplier = "-";
                                                $a = $db->query("select count(*) as jumlah from register where kodeproyek = '".$d['kodeproyek']."'")->getRowArray()['jumlah'];
                                                $b = $db->query("select count(*) as jumlah from hasil where kodeproyek = '".$d['kodeproyek']."'")->getRowArray()['jumlah'];
                                                if($a == $b){
                                                    $supplier = $db->query("select pengguna.nama from hasil join pengguna on hasil.kodepengguna = pengguna.kodepengguna where hasil.kodeproyek = '".$d['kodeproyek']."' order by hasil.na desc")->getRowArray()['nama'];
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $d['kodeproyek'] ?></td>
                                                    <td><?php echo $d['proyek'] ?></td>
                                                    <td><?php echo $d['deskripsi'] ?></td>
                                                    <td><?php echo number_format($d['biaya']) ?></td>
                                                    <td><?php
                                                    if($d['status'] == '1'){
                                                        echo "Aktif";
                                                    }else{
                                                        echo "Nonaktif";
                                                    }
                                                    ?></td>
                                                    <td><?php echo $supplier ?></td>
                                                    <td align="center" width="10%">
                                                        <?php if($supplier == '-'){ ?>
                                                            <marquee direction="left">
                                                                Proses Verifikasi Data....
                                                            </marquee>
                                                        <?php }else{ ?>
                                                            <a href="<?php echo base_url('result/detail/'.$d['kodeproyek']) ?>" class="btn btn-warning btn-xs">Detail Analisa</a>
                                                        <?php } ?>
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
            <?php echo view('supplier/bagianfooter') ?>
        </div>
    </div>
    <?php echo view('supplier/bagianscript') ?>
</body>
</html>