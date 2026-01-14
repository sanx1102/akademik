<div class="container py-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h3 class="fw-bold mb-4">Input Data Mahasiswa</h3>

            <form action="proses.php" method="post">

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Program Studi <span class="text-danger">*</span>
                    </label>

                    <select class="form-select" name="prodi" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <?php
                        require_once __DIR__ . '/../koneksi.php';
                        $query_prodi = mysqli_query($koneksi, "SELECT * FROM program_studi ORDER BY nama_prodi");
                        while ($prodi = mysqli_fetch_array($query_prodi)) {
                            echo "<option value='" . $prodi['id'] . "'>";
                            echo $prodi['nama_prodi'] . " (" . $prodi['jenjang'] . ")";
                            if (!empty($prodi['akreditasi'])) {
                                echo " - Akreditasi: " . $prodi['akreditasi'];
                            }
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <div class="form-text">Pilih program studi mahasiswa</div>
                </div>

                <div class="d-flex justify-content-between gap-2 mt-4">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="./index.php?p=data_mhs" class="btn btn-secondary">Lihat List</a>

                </div>

            </form>

        </div>
    </div>

</div>