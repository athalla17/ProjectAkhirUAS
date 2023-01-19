<?php
$db = db_connect();
if($proyek != ''){
    $s = $db->query("select status from proyek where kodeproyek = '".$proyek."'")->getRowArray()['status'];
}
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
                    <h2>Data Skema Penilaian</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Data Skema Penilaian</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <form action="<?php echo base_url('skema/tampil') ?>" method="post">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Proyek Berjalan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control form-control-sm" name="proyek" required onchange="this.form.submit();">
                                                <option value="" <?php if($proyek == ""){echo "selected";} ?>>- Pilih Proyek Berjalan - </option>
                                                <?php foreach ($data as $d) {?>
                                                    <option <?php if($proyek == $d['kodeproyek']){echo "selected";} ?> value="<?php echo $d['kodeproyek'] ?>"><?php echo $d['proyek']." : ".number_format($d['biaya']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php if($proyek != ""){ ?>
                                <form action="<?php echo base_url('skema/simpan') ?>" method="post">
                                    <input type="hidden" name="proyek" value="<?php echo $proyek ?>">
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Kriteria Penilaian</th>
                                                        <th>Kategori</th>
                                                        <th width="10%">Bobot</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($kriteria as $k) {
                                                        $bobot = 0;
                                                        $cek = $db->query("select bobot from skema where kodekriteria = '".$k['kodekriteria']."' and kodeproyek = '".$proyek."'")->getResultArray();
                                                        if(count($cek) > 0){
                                                            $bobot = $cek[0]['bobot'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $k['kodekriteria']." - ".$k['kriteria'] ?></td>
                                                            <td><?php echo $k['kategori'] ?></td>
                                                            <td>
                                                                <?php if($s == '1'){ ?>
                                                                    <input type="number" name="bobot<?php echo $k['kodekriteria'] ?>" class="form-control form-control-sm" min="0" value="<?php echo $bobot ?>" onchange="this.form.submit();" required autofocus>
                                                                    <?php
                                                                }else{
                                                                    echo $bobot;
                                                                }    
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                    </div>
                                </form>
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