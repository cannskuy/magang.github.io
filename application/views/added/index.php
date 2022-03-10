<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- TABEL-->
    <div class="table-container mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Laporan Peminjaman</strong>
                        </div>

                        <?= $this->session->flashdata('message'); ?>


                        <!-- data pinjaman -->
                        <table class="table table-striped table-hover table-bordered ">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peminjam</th>
                                    <th>NPP</th>
                                    <th>Unit Kerja</th>
                                    <th>Keperluan/Tujuan</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pinjam as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $p['name']; ?></td>
                                        <td><?= $p['NPP']; ?></td>
                                        <td><?= $p['unit_kerja']; ?></td>
                                        <td><?= $p['tujuan']; ?></td>
                                        <td><?= $p['start']; ?></td>
                                        <td><?= $p['end']; ?></td>
                                        <td>
                                            <a href="<?= base_url('/form/form2/' . $p['form_id']); ?>" class="badge rounded-pill bg-success text-light" target="_blank">Accept</a>
                                            <a href="<?= base_url('/added/delete/' . $p['form_id']); ?> " class="badge rounded-pill bg-danger text-light" onclick="return confirm (' Hapus permintaan ini?')">Hapus</a>
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
<!-- /.container-fluid -->