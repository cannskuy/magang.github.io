<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Form Peminjaman</strong>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card-body card-block">
            <div class="bootstrap-iso">
                <form action="<?= base_url('form'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Peminjam</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" placeholder="Nama Peminjam" class="form-control" required></div>
                    </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NPP</label></div>
                <div class="col-12 col-md-9"><input type="text" id="NPP" name="NPP" placeholder="NPP" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Unit Kerja</label></div>
                <div class="col-12 col-md-9"><input type="text" id="unit_kerja" name="unit_kerja" placeholder="Unit Kerja" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Keperluan/Tujuan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="tujuan" name="tujuan" placeholder="Keperluan/Tujuan" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="datetime-local-input" class=" form-control-label">Tanggal Awal Peminjaman</label></div>
                <div class="col-12 col-md-9"><input type="datetime-local" id="start" name="start" placeholder="Tanggal Awal Peminjaman" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="datetime-local-input" class=" form-control-label">Tanggal Akhir Peminjaman</label></div>
                <div class="col-12 col-md-9"><input type="datetime-local" id="end" name="end" placeholder="Tanggal Akhir Peminjaman" class="form-control" required></div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"></div>
                <div class="col-12 col-md-9">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>