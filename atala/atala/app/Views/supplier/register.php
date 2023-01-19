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
                    <h2>Data Proyek</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Data Proyek</strong>
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
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data as $d) {
                                                $status = "";
                                                $cek = $db->query("select status from register where kodepengguna = '".session()->get('supplier')."' and kodeproyek = '".$d['kodeproyek']."'")->getResultArray();
                                                if(count($cek) > 0){
                                                    $status = $db->query("select status from register where kodepengguna = '".session()->get('supplier')."' and kodeproyek = '".$d['kodeproyek']."'")->getRowArray()['status'];
                                                    $cek = $db->query("select * from nilai where kodepengguna = '".session()->get('supplier')."' and kodeproyek = '".$d['kodeproyek']."'")->getResultArray();
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $d['kodeproyek'] ?></td>
                                                    <td><?php echo $d['proyek'] ?></td>
                                                    <td><?php echo $d['deskripsi'] ?></td>
                                                    <td><?php echo number_format($d['biaya']) ?></td>
                                                    <td align="center">
                                                        <?php if($status == ""){?>
                                                            <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ambil<?php echo $d['kodeproyek'] ?>">Ambil Proyek</button>
                                                        <?php } ?>
                                                        <?php if($status == "1" && count($cek) == 0){?>
                                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#batal<?php echo $d['kodeproyek'] ?>">Batalkan</button>
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
<?php
foreach ($data as $d) {
    $cek = $db->query("select status from register where kodepengguna = '".session()->get('supplier')."' and kodeproyek = '".$d['kodeproyek']."'")->getResultArray();
    ?>
    <div class="modal inmodal" id="ambil<?php echo $d['kodeproyek'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong style="font-size: 13pt;">Ambil Proyek</strong><br>
                    <code>PENTING!!!</code> proyek hanya bisa diambil ataupun dibatalkan <strong>SATU KALI</strong>
                </div>
                <div class="modal-body">
                    <table class="table" style="border: none;">
                        <tr>
                            <th width="27%">Kode</th>
                            <td>: <?php echo $d['kodeproyek'] ?></td>
                        </tr>
                        <tr>
                            <th width="27%">Nama</th>
                            <td>: <?php echo $d['proyek'] ?></td>
                        </tr>
                        <tr>
                            <th width="27%">Biaya</th>
                            <td>: <?php echo number_format($d['biaya']) ?></td>
                        </tr>
                        <tr>
                            <th width="27%">Deskripsi</th>
                            <td>: <?php echo nl2br($d['deskripsi']) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="window.location.href='<?php echo base_url('register/ambil/'.$d['kodeproyek']) ?>'" class="btn btn-primary btn-sm">Ambil Proyek</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(count($cek) > 0){
        $cek = $db->query("select * from register where kodepengguna = '".session()->get('supplier')."' and kodeproyek = '".$d['kodeproyek']."'")->getRowArray();
        ?>
        <div class="modal inmodal" id="batal<?php echo $d['kodeproyek'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong style="font-size: 13pt;">Batalkan Proyek</strong><br>
                        <code>PENTING!!!</code> proyek hanya bisa diambil ataupun dibatalkan <strong>SATU KALI</strong>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table" style="border: none;">
                                    <tr>
                                        <th width="27%">Kode Reg.</th>
                                        <td>: <?php echo $d['kodeproyek'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Nama</th>
                                        <td>: <?php echo $d['proyek'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Biaya</th>
                                        <td>: <?php echo number_format($d['biaya']) ?></td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Deskripsi</th>
                                        <td>: <?php echo nl2br($d['deskripsi']) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table" style="border: none;">
                                    <tr>
                                        <th width="27%">Kode Reg.</th>
                                        <td>: <?php echo $cek['koderegister'] ?></td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Waktu</th>
                                        <td>: <?php echo date('d/m/Y H:i:s', strtotime($cek['waktu'])) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="window.location.href='<?php echo base_url('register/batal/'.$cek['koderegister']) ?>'" class="btn btn-danger btn-sm">Batalkan Proyek</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
</html>