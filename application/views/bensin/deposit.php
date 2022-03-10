<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Deposit</strong>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card-body card-block">
            <div class="bootstrap-iso">
                <form action="<?= base_url('bensin/deposit'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="datetime-local-input" class=" form-control-label">Tanggal Deposit</label></div>
                        <div class="col-12 col-md-9"><input type="datetime-local" id="tanggal" name="tanggal" placeholder="Tanggal Awal Peminjaman" class="form-control" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="number-input" class=" form-control-label">Deposit</label></div>
                        <div class="col-12 col-md-9"><input type="number" id="masuk" name="masuk" placeholder="Deposit" class="form-control" required></div>
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