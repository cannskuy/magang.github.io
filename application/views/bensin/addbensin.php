<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- TABEL-->
    <div class="table-container mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Laporan BBM</strong>
                            <br>
                            <a href="<?= base_url('/bensin/export_excel') ?>" class="btn btn-success"><i class="fa fa-print"></i> Export data</a>
                        </div>

                        <?= $this->session->flashdata('message'); ?>



                        <!-- data pinjaman -->
                        <table class="table table-striped table-hover table-bordered ">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No Polisi</th>
                                    <th>Pembelian</th>
                                    <th>Pemakaian</th>
                                    <th>Saldo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($bensin as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $p['tanggal']; ?></td>
                                        <td><?= $p['plat']; ?></td>
                                        <td><?= "Rp. " . number_format($p['masuk'], 0, '', '.') . ',-'; ?></td>
                                        <td><?= "Rp. " . number_format($p['harga'], 0, '', '.') . ',-'; ?></td>
                                        <td><?= "Rp. " . number_format($p['saldo'], 0, '', '.') . ',-'; ?></td>
                                        <td>
                                            <a href="<?= base_url('/bensin/delete/' . $p['id']); ?> " class="badge rounded-pill bg-danger text-light" onclick="return confirm (' Hapus permintaan ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>