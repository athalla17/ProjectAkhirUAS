<?php $db = db_connect(); ?>
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
                    <h2>Proses Analisa</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Proses Analisa</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <form action="<?php echo base_url('proses/tampil') ?>" method="post">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Proyek Berjalan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="proyek" required onchange="this.form.submit();">
                                                <option value="" <?php if($proyek == ""){echo "selected";} ?>>- Pilih Proyek Berjalan - </option>
                                                <?php foreach ($data as $d) {?>
                                                    <option <?php if($proyek == $d['kodeproyek']){echo "selected";} ?> value="<?php echo $d['kodeproyek'] ?>"><?php echo $d['proyek']." : ".number_format($d['biaya']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php if($proyek != '' && count($supplier) > 1){ ?>
                                            <div class="col-sm-2">
                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('proses/analisa/'.$proyek) ?>">Proses Analisa</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                            <?php if($proyek != ""){ ?>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Supplier</th>
                                                    <?php foreach ($kriteria as $k) {?>
                                                        <th><?php echo $k['kriteria'] ?></th>
                                                    <?php } ?>
                                                    <th>NA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($supplier as $s) {
                                                    $na = 0;
                                                    $cek = $db->query("select * from hasil where kodeproyek = '".$proyek."' and kodepengguna = '".$s['kodepengguna']."'")->getResultArray();
                                                    if(count($cek) > 0){
                                                        $na = $db->query("select * from hasil where kodeproyek = '".$proyek."' and kodepengguna = '".$s['kodepengguna']."'")->getRowArray()['na'];
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <strong><?php echo $s['nama'] ?></strong><br>
                                                            <small><?php echo $s['kota'].", ".$s['provinsi'] ?></small>
                                                        </td>
                                                        <?php
                                                        foreach ($kriteria as $k) {
                                                            $indikator = "-";
                                                            $cek = $db->query("select kodeindikator from nilai where kodekriteria = '".$k['kodekriteria']."' and kodeproyek = '".$proyek."' and kodepengguna = '".$s['kodepengguna']."'")->getResultArray();
                                                            if(count($cek) > 0){
                                                                $cek = $db->query("select kodeindikator from nilai where kodekriteria = '".$k['kodekriteria']."' and kodeproyek = '".$proyek."' and kodepengguna = '".$s['kodepengguna']."'")->getRowArray();
                                                                $indikator = $db->query("select indikator from indikator where kodeindikator = '".$cek['kodeindikator']."'")->getRowArray()['indikator'];
                                                            }
                                                            ?>
                                                            <td><?php echo $indikator ?></td>
                                                        <?php } ?>
                                                        <td><?php echo number_format($na,4) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('admin/bagianfooter') ?>
        </div>
    </div>
    <?php echo view('admin/bagianscript') ?>
</body>
</html>