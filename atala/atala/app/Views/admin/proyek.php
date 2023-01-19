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
                                                    <td align="center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#detail<?php echo $d['kodeproyek'] ?>">Detail Data</button></td>
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
            <form action="<?php echo base_url('proyek/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Proyek</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Proyek Lengkap Proyek" class="form-control form-control-sm" name="proyek" required>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Biaya</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Biaya Proyek" class="form-control form-control-sm" name="biaya" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Deskripsi</label>
                        <div class="col-lg-10">
                            <textarea placeholder="Deskripsi Lengkap Proyek" class="form-control form-control-sm" name="deskripsi" rows="3" style="resize: none;height: 90px;" required></textarea>
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
<?php foreach ($data as $d) {?>
    <div class="modal inmodal" id="detail<?php echo $d['kodeproyek'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong style="font-size: 13pt;">Detail Data</strong><br>
                    input perubahan detail data seusai dengan inputan form, lalu pilih <strong>Simpan Data</strong>
                </div>
                <form action="<?php echo base_url('proyek/ubah') ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $d['kodeproyek'] ?>">
                    <div class="modal-body">
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Proyek</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Proyek Lengkap Proyek" class="form-control form-control-sm" name="proyek" required value="<?php echo $d['proyek'] ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Biaya</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="No. Biaya Proyek" class="form-control form-control-sm" name="biaya" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required value="<?php echo $d['biaya'] ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Deskripsi</label>
                            <div class="col-lg-10">
                                <textarea placeholder="Deskripsi Lengkap Proyek" class="form-control form-control-sm" name="deskripsi" rows="3" style="resize: none;height: 90px;" required><?php echo $d['deskripsi'] ?></textarea>
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