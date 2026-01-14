<?php
session_start();
require "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['id'];

$stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan.";
    exit();
}

$success = "";
$error = "";

// submit edit
if (isset($_POST['submit'])) {
    $nama = trim($_POST['nama_lengkap'] ?? "");
    $pass_lama = $_POST['password_lama'] ?? "";
    $pass_baru = $_POST['password_baru'] ?? "";
    $pass2 = $_POST['password2'] ?? "";

    if ($nama === "") {
        $error = "Nama tidak boleh kosong.";
    } else {
        // update nama selalu
        $up = $koneksi->prepare("UPDATE pengguna SET nama_lengkap = ? WHERE id = ?");
        $up->bind_param("si", $nama, $id);
        $up->execute();
        $_SESSION['nama'] = $nama;

        // kalau user isi password baru → ganti password juga
        if ($pass_lama !== "" || $pass_baru !== "" || $pass2 !== "") {
            if (!password_verify($pass_lama, $user['password'])) {
                $error = "Password lama salah.";
            } elseif (strlen($pass_baru) < 6) {
                $error = "Password baru minimal 6 karakter.";
            } elseif ($pass_baru !== $pass2) {
                $error = "Konfirmasi password tidak cocok.";
            } else {
                $hash = password_hash($pass_baru, PASSWORD_DEFAULT);
                $up2 = $koneksi->prepare("UPDATE pengguna SET password = ? WHERE id = ?");
                $up2->bind_param("si", $hash, $id);
                $up2->execute();
                $success = "Profil & password berhasil diupdate.";
            }
        } else {
            $success = "Profil berhasil diupdate.";
        }

        // refresh data
        $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0">Edit Pengguna</h3>
            <a href="profil.php" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <?php if ($success) : ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($error) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                            value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold">Ganti Password (Opsional)</h6>

                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" placeholder="Isi jika ingin ganti password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" placeholder="Minimal 6 karakter">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password2" class="form-control">
                    </div>

                    <div class="d-flex gap-2 justify-content-between mt-4">
                        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                        <a href="profil.php" class="btn btn-outline-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>

</html>