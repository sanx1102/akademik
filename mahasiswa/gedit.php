<?php
include("../koneksi.php");

if (!isset($_GET['key'])) {
    echo "Data tidak ditemukan";
    exit();
}

$nim = $_GET['key'];

$edit = $koneksi->query("SELECT * FROM mahasiswa WHERE nim = '$nim'");
$data = $edit->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan";
    exit();
}

if (isset($_POST['submit'])) {
    $nama    = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $alamat  = $_POST['alamat'];
    $prodi   = $_POST['program_studi_id'];

    $sql = "UPDATE mahasiswa SET 
                nama = '$nama', 
                tgl_lahir = '$tanggal', 
                alamat = '$alamat',
                id_prodi = '$prodi'
            WHERE nim = '$nim'";

    $query = $koneksi->query($sql);

    if ($query) {
        echo "<script>s
                alert('Data berhasil diubah!');
                window.location.href = '../index.php?p=data_mhs';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal mengubah data.');
              </script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <h3 class="fw-bold mb-4">Edit Data Mahasiswa</h3>

                <form method="post" action="">

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"
                            value="<?= htmlspecialchars($data['nim']) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="<?= htmlspecialchars($data['nama']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="<?= htmlspecialchars($data['tgl_lahir']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            value="<?= htmlspecialchars($data['alamat']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="program_studi_id" class="form-label">Program Studi</label>
                        <select class="form-select" id="program_studi_id" name="program_studi_id" required>
                            <option value="">-- Pilih Program Studi --</option>

                            <?php
                            $query_prodi = mysqli_query($koneksi, "SELECT * FROM program_studi ORDER BY nama_prodi, jenjang");
                            while ($prodi = mysqli_fetch_array($query_prodi)) {
                                $selected = ($data['program_studi_id'] == $prodi['id']) ? 'selected' : '';
                                echo "<option value='{$prodi['id']}' $selected>";
                                echo htmlspecialchars($prodi['nama_prodi']) . " (" . $prodi['jenjang'] . ")";
                                echo "</option>";
                            }
                            ?>
                        </select>

                        <div class="form-text text-muted">Pilih program studi mahasiswa</div>
                    </div>

                    <div class="d-flex justify-content-between gap-2 mt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            Update
                        </button>

                        <a href="../index.php?p=data_mhs" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>

</html>