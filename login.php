<?php
session_start();
require 'koneksi.php';

$error = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";

    if ($email == "" || $password == "") {
        $error = "Email dan password wajib diisi.";
    } else {


        $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result && $result->num_rows == 1) {
            $data = $result->fetch_assoc();


            if (password_verify($password, $data['password'])) {

                $_SESSION['login'] = TRUE;
                $_SESSION['email'] = $data['email'];
                $_SESSION['nama']  = $data['nama_lengkap'];
                $_SESSION['id']    = $data['id'];

                echo "<script>
                        alert('Berhasil Login!');
                        window.location.href = 'index.php';
                      </script>";
                exit;
            } else {
                $error = "Login gagal. Email atau password salah.";
            }
        } else {
            $error = "Login gagal. Email atau password salah.";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <?php if ($error != "") : ?>
                    <div class="alert alert-danger mt-3 text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['register']) && $_GET['register'] == 'success') : ?>
                    <div class="alert alert-success mt-3 text-center">
                        Registrasi berhasil! Silakan login.
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm border-0 rounded-4 mt-3">
                    <div class="card-body p-4">
                        <h1 class="mb-4">Login Form</h1>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>

                            <div class="text-center mt-3">
                                Belum punya akun? <a href="pengguna/register.php">Register</a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>