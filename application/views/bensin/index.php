<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Form BBM</strong>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card-body card-block">
            <div class="bootstrap-iso">
                <form action="<?= base_url('bensin'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Polisi</label></div>
                        <select class="form-control col-12 col-md-9" id="no_polisi" name="no_polisi">
                            <?php foreach ($nopol as $n) : ?>
                                <option value="<?= $n['plat']; ?>"><?= $n['plat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="datetime-local-input" class=" form-control-label">Tanggal Pembelian</label></div>
                        <div class="col-12 col-md-9"><input type="datetime-local" id="tanggal" name="tanggal" placeholder="Tanggal Awal Peminjaman" class="form-control" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="number-input" class=" form-control-label">Harga (rupiah)</label></div>
                        <div class="col-12 col-md-9"><input type="number" id="harga" name="harga" placeholder="Harga (rupiah)" class="form-control" required></div>
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