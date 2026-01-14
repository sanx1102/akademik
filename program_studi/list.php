<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0"></h4>
    <a href="program_studi/create.php" class="btn btn-primary btn-sm">
        + Input Program Studi
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Nama Program Studi</th>
                        <th>Jenjang</th>
                        <th>Akreditasi</th>
                        <th>Keterangan</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('koneksi.php');
                    $tampil = $koneksi->query("SELECT * FROM program_studi ORDER BY id DESC");
                    while ($data = mysqli_fetch_assoc($tampil)) {
                    ?>
                        <tr>
                            <td><?= $data['id']; ?></td>
                            <td><?= htmlspecialchars($data['nama_prodi']); ?></td>
                            <td><?= htmlspecialchars($data['jenjang']); ?></td>
                            <td><?= htmlspecialchars($data['akreditasi']); ?></td>
                            <td><?= htmlspecialchars($data['keterangan']); ?></td>
                            <td>
                                <a href="program_studi/gedit.php?id=<?= $data['id']; ?>"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <a href="program_studi/ghapus.php?id=<?= $data['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>