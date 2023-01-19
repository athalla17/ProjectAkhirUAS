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
                    <h2>Penilaian Proyek</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Nilai Proyek</strong>
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
                                                <th>Waktu. Reg</th>
                                                <th>Proyek</th>
                                                <th>Deskripsi</th>
                                                <th>Biaya</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $d) {?>
                                                <tr>
                                                    <td><?php echo $d['kodeproyek'] ?></td>
                                                    <td><?php echo date('d/m/Y H:i:s', strtotime($d['waktu'])) ?></td>
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
                                                    <td align="center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#detail<?php echo $d['kodeproyek'] ?>">Detail Nilai</button></td>
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
<?php
foreach ($data as $d) {
    $kriteria = $db->query("select kriteria.* from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$d['kodeproyek']."'")->getResultArray();
    $cek = $db->query("select * from nilai where kodeproyek = '".$d['kodeproyek']."' and kodepengguna = '".session()->get('supplier')."'")->getResultArray();
    ?>
    <div class="modal inmodal" id="detail<?php echo $d['kodeproyek'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong style="font-size: 13pt;">Detail Nilai</strong><br>
                    <?php if(count($cek) == 0){ ?>
                        input perubahan detail data seusai dengan inputan form, lalu pilih <strong>Simpan Data</strong><br>
                        <code>PENTING!!!</code> penilaian kriteria proyek hanya bisa diinput <strong>SATU KALI</strong>
                    <?php } ?>
                </div>
                <?php if(count($cek) == 0){ ?>
                    <form action="<?php echo base_url('penilaian/simpan') ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $d['kodeproyek'] ?>">
                        <div class="modal-body">
                            <?php
                            foreach ($kriteria as $k) {
                                $indikator = $db->query("select * from indikator where kodekriteria = '".$k['kodekriteria']."' order by nilai asc")->getResultArray();
                                ?>
                                <div class="form-group row"><label class="col-lg-2 col-form-label"><?php echo $k['kriteria'] ?></label>
                                    <div class="col-lg-10">
                                        <select class="form-control form-control-sm" name="k<?php echo $k['kodekriteria'] ?>" required>
                                            <?php foreach ($indikator as $i) {?>
                                                <option value="<?php echo $i['nilai'] ?>"><?php echo $i['indikator'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                        </div>
                    </form>
                <?php }else{ ?>
                    <div class="modal-body">
                        <table style="border: none;">
                            <?php
                            foreach ($kriteria as $k) {
                                $i = $db->query("select indikator.indikator, nilai.nilai from nilai join indikator on indikator.kodeindikator = nilai.kodeindikator where nilai.kodekriteria = '".$k['kodekriteria']."' and nilai.kodeproyek = '".$d['kodeproyek']."' and nilai.kodepengguna ='".session()->get('supplier')."'")->getRowArray();
                                ?>
                                <tr style="line-height: 36px;">
                                    <th><?php echo $k['kriteria'] ?></th>
                                    <td>: <?php echo $i['indikator'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
</html>