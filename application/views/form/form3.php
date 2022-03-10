<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Form Laporan</strong>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card-body card-block">
            <div class="bootstrap-iso">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="form_id" value="<?= $input['form_id']; ?>">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Peminjam</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" value="<?= $input['name']; ?>" class="form-control" readonly></div>
                    </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NPP</label></div>
                <div class="col-12 col-md-9"><input type="text" id="NPP" name="NPP" value="<?= $input['NPP']; ?>" class="form-control" readonly></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Kerja</label></div>
                <div class="col-12 col-md-9"><input type="text" id="unit_kerja" name="unit_kerja" value="<?= $input['unit_kerja']; ?>" class="form-control" readonly></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Keperluan/Tujuan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="tujuan" name="tujuan" value="<?= $input['tujuan']; ?>" class="form-control" readonly></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="datetime-local-input" class=" form-control-label">Tanggal Pengembalian</label></div>
                <div class="col-12 col-md-9"><input type="datetime-local" id="end" name="end" placeholder="Tanggal Akhir Peminjaman" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kondisi Setelah Dikembalikan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="ket" name="ket" class="form-control" required></div>
            </div>

            <div class="row form-group">
                <div class="col col-md-3"></div>
                <div class="col-12 col-md-9">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Update Kondisi
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>