<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0"></h4>

    <a href="index.php?p=create_mhs" class="btn btn-primary btn-sm">
        + Input Mahasiswa
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Program Studi</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require('koneksi.php');

                    $tampil = $koneksi->query("
                        SELECT m.*, p.nama_prodi 
                        FROM mahasiswa m 
                        LEFT JOIN program_studi p 
                        ON m.id_prodi = p.id
                        ORDER BY m.nim DESC
                    ");

                    $no = 1;
                    while ($data = mysqli_fetch_assoc($tampil)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['nim']); ?></td>
                            <td><?= htmlspecialchars($data['nama']); ?></td>
                            <td><?= htmlspecialchars($data['tgl_lahir']); ?></td>
                            <td><?= htmlspecialchars($data['alamat']); ?></td>
                            <td><?= htmlspecialchars($data['nama_prodi'] ?? '-'); ?></td>

                            <td>
                                <a href="mahasiswa/gedit.php?key=<?= urlencode($data['nim']); ?>"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="mahasiswa/ghapus.php?nim=<?= urlencode($data['nim']); ?>"
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