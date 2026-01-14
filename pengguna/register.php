<?php
session_start();
include "../koneksi.php";


if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: ../home.php");
    exit();
}

$errors = [];

if (isset($_POST['register'])) {
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? "");
    $email        = trim($_POST['email'] ?? "");
    $password     = $_POST['password'] ?? "";
    $password2    = $_POST['password2'] ?? "";


    if ($nama_lengkap === "") $errors[] = "Nama lengkap wajib diisi.";
    if ($email === "") $errors[] = "Email wajib diisi.";
    if ($password === "") $errors[] = "Password wajib diisi.";
    if ($password2 === "") $errors[] = "Konfirmasi password wajib diisi.";

    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if ($password !== "" && strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter.";
    }

    if ($password !== $password2) {
        $errors[] = "Password dan konfirmasi password tidak sama.";
    }


    if (empty($errors)) {
        $check = $koneksi->prepare("SELECT id FROM pengguna WHERE email = ? LIMIT 1");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Email sudah terdaftar. Silakan gunakan email lain.";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $insert = $koneksi->prepare("INSERT INTO pengguna (email, password, nama_lengkap) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $email, $hashed, $nama_lengkap);

            if ($insert->execute()) {
                header("Location: login.php?register=success");
                exit();
            } else {
                $errors[] = "Registrasi gagal: " . $koneksi->error;
            }
        }
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="text-center mb-4 fw-bold">Register</h3>


                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $e) : ?>
                                        <li><?= htmlspecialchars($e) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>


                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                <div class="form-text">Minimal 6 karakter.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password2" class="form-control" required>
                            </div>

                            <button type="submit" name="register" class="btn btn-primary w-100 rounded-3">
                                Daftar
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <span>Sudah punya akun?</span>
                            <a href="../login.php" class="text-decoration-none fw-semibold">Login</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>