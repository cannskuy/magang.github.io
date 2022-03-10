<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Form Peminjaman</strong>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card-body card-block">
            <div class="bootstrap-iso">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="form_id" value="<?= $input['form_id']; ?>">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Peminjam</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" value="<?= $input['name']; ?>" class="form-control" required></div>
                    </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NPP</label></div>
                <div class="col-12 col-md-9"><input type="text" id="NPP" name="NPP" value="<?= $input['NPP']; ?>" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Kerja</label></div>
                <div class="col-12 col-md-9"><input type="text" id="unit_kerja" name="unit_kerja" value="<?= $input['unit_kerja']; ?>" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Keperluan/Tujuan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="tujuan" name="tujuan" value="<?= $input['tujuan']; ?>" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text" class=" form-control-label">Tanggal Awal Peminjaman</label></div>
                <div class="col-12 col-md-9"><label for="text" class=" form-control-label"><?= $input['start']; ?></label></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="datetime-local-input" class=" form-control-label">Tanggal Awal Disetujui</label></div>
                <div class="col-12 col-md-9"><input type="datetime-local" id="start" name="start" placeholder="Tanggal Awal Peminjaman" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text" class=" form-control-label">Tanggal Akhir Peminjaman</label></div>
                <div class="col-12 col-md-9"><label for="text" class=" form-control-label"><?= $input['end']; ?></label></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Polisi</label></div>
                <select class="form-control col-12 col-md-9" id="no_polisi" name="no_polisi">
                    <?php foreach ($nopol as $n) : ?>
                        <option value="<?= $n['plat']; ?>"><?= $n['plat']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Driver</label></div>
                <select class="form-control col-12 col-md-9" id="driver" name="driver">
                    <?php foreach ($nopol as $n) : ?>
                        <option value="<?= $n['nama_driver']; ?>"><?= $n['nama_driver']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"></div>
                <div class="col-12 col-md-9">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Lanjut
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>