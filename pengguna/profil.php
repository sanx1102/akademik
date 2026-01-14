<?php
session_start();
require "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['id'];

$stmt = $koneksi->prepare("SELECT id, email, nama_lengkap FROM pengguna WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan.";
    exit();
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-0">Profil Pengguna</h3>
                <p class="text-muted mb-0">Kelola akun kamu</p>
            </div>
            <a href="../index.php" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <p class="mb-1"><b>Nama:</b> <?= htmlspecialchars($user['nama_lengkap']) ?></p>
                <p class="mb-4"><b>Email:</b> <?= htmlspecialchars($user['email']) ?></p>

                <div class="d-flex gap-2">
                    <a href="edit.php" class="btn btn-primary">Edit Pengguna</a>

                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusAkun">
                        Hapus Akun
                    </button>

                </div>
            </div>
        </div>

    </div>
    <!-- Modal Hapus Akun -->
    <div class="modal fade" id="modalHapusAkun" tabindex="-1" aria-labelledby="modalHapusAkunLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header">
                    <h5 class="modal-title text-danger fw-bold" id="modalHapusAkunLabel">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="proses_hapus.php" method="POST">
                    <div class="modal-body">
                        <div class="alert alert-warning mb-3">
                            <b>Peringatan:</b> Akun kamu akan dihapus permanen dan tidak bisa dikembalikan.
                        </div>

                        <label class="form-label">Masukkan password untuk konfirmasi:</label>
                        <input type="password" name="password" class="form-control" placeholder="Password..." required>
                        <div class="form-text text-muted">
                            Password tidak akan ditampilkan.
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus Akun</button>
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