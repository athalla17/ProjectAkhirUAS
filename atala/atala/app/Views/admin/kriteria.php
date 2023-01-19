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
                    <h2>Data Kriteria</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('') ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pengolahan Data Kriteria</strong>
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
                                                <th>Kriteria</th>
                                                <th>Kategori</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $d) {?>
                                                <tr>
                                                    <td><?php echo $d['kodekriteria'] ?></td>
                                                    <td><?php echo $d['kriteria'] ?></td>
                                                    <td><?php echo $d['kategori'] ?></td>
                                                    <td align="center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#detail<?php echo $d['kodekriteria'] ?>">Detail Data</button></td>
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
            <form action="<?php echo base_url('kriteria/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Kriteria</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Nama Kriteria" class="form-control form-control-sm" name="kriteria" required>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Kategori</label>
                        <div class="col-lg-10">
                            <select class="form-control form-control-sm" name="kategori" required>
                                <option>Cost</option>
                                <option>Benefit</option>
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
<?php foreach ($data as $d) {?>
    <div class="modal inmodal" id="detail<?php echo $d['kodekriteria'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong style="font-size: 13pt;">Detail Data</strong><br>
                    input perubahan detail data seusai dengan inputan form, lalu pilih <strong>Simpan Data</strong>
                </div>
                <form action="<?php echo base_url('kriteria/ubah') ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $d['kodekriteria'] ?>">
                    <div class="modal-body">
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Kriteria</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Nama Kriteria" class="form-control form-control-sm" name="kriteria" required value="<?php echo $d['kriteria'] ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Kategori</label>
                            <div class="col-lg-10">
                                <select class="form-control form-control-sm" name="kategori" required>
                                    <option <?php if($d['kategori'] == 'Cost'){echo "selected";} ?>>Cost</option>
                                    <option <?php if($d['kategori'] == 'Benefit'){echo "selected";} ?>>Benefit</option>
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