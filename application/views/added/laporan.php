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
                            <br>
                            <a href="<?= base_url('/added/export_excel') ?>" class="btn btn-success"><i class="fa fa-print"></i> Export data</a>
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
                                    <th>Plat No</th>
                                    <th>Driver</th>
                                    <th>Kondisi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($form_pinjam as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $p['name']; ?></td>
                                        <td><?= $p['NPP']; ?></td>
                                        <td><?= $p['unit_kerja']; ?></td>
                                        <td><?= $p['tujuan']; ?></td>
                                        <td><?= $p['start']; ?></td>
                                        <td><?= $p['end']; ?></td>
                                        <td><?= $p['no_polisi']; ?></td>
                                        <td><?= $p['driver']; ?></td>
                                        <td><?= $p['ket']; ?></td>
                                        <td>
                                            <?php $message = "Peminjaman kendaraan atas nama " . $p['name'] . " untuk tanggal " . $p['start'] . " sampai " . $p['end'] . " telah berhasil dibuat. Driver untuk perjalanan ini adalah " . $p['driver'] . ". Perjalanan ini akan menggunakan mobil berplat nomor " . $p['no_polisi'] . ". (Ini adalah pesan otomatis)"; ?>
                                            <?php $waDriver = $this->db->get_where('driver', ['nama_driver' => $p['driver']])->row_array(); ?>
                                            <?php $waUser = $this->db->get_where('user', ['NPP' => $p['NPP']])->row_array(); ?>
                                            <a href="<?= 'https://api.whatsapp.com/send?phone=' . $waDriver['wa'] . '&text=' . $message ?>" class="badge rounded-pill bg-success text-light" target="_blank">Chat Driver</a>
                                            <a href="<?= 'https://api.whatsapp.com/send?phone=' . $waUser['noHP_user'] . '&text=' . $message ?>" class="badge rounded-pill bg-success text-light" target="_blank">Chat Peminjam</a>
                                            <a href="<?= base_url('/form/form3/' . $p['form_id']); ?>" class="badge rounded-pill bg-primary text-light" target="_blank">Update</a>
                                            <a href="<?= base_url('/added/cetak/' . $p['form_id']); ?>" class="badge rounded-pill bg-warning text-light" target="_blank">Cetak</a>
                                            <a href="<?= base_url('/added/deleteForm/' . $p['form_id']); ?> " class="badge rounded-pill bg-danger text-light" onclick="return confirm (' Hapus permintaan ini?')">Hapus</a>
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

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>