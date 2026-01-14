<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            background: whiteSmoke;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        .content-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <div class="page-wrapper">


        <nav class="navbar navbar-expand-lg bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">Data Akademik</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav gap-1">
                        <a class="nav-link <?= (!isset($_GET['p']) || $_GET['p'] == 'home') ? 'active fw-semibold' : '' ?>"
                            href="index.php">Home</a>

                        <a class="nav-link <?= (isset($_GET['p']) && str_contains($_GET['p'], 'mhs')) ? 'active fw-semibold' : '' ?>"
                            href="index.php?p=data_mhs">Mahasiswa</a>

                        <a class="nav-link <?= (isset($_GET['p']) && str_contains($_GET['p'], 'prodi')) ? 'active fw-semibold' : '' ?>"
                            href="index.php?p=data_prodi">Program Studi</a>
                    </div>

                    <div class="ms-auto d-flex align-items-center gap-2">
                        <a class="btn btn-sm" href="pengguna/profil.php">
                            <?= htmlspecialchars($_SESSION['nama'] ?? 'Pengguna') ?>
                        </a>
                        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
                    </div>
                </div>
            </div>
        </nav>


        <div class="container py-4">


            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                <div>
                    <h4 class="mb-1 fw-bold">
                        <?php
                        $p = $_GET['p'] ?? 'home';
                        if ($p == 'data_mhs') echo "Data Mahasiswa";
                        elseif ($p == 'create_mhs') echo "Tambah Mahasiswa";
                        elseif ($p == 'edit_mhs') echo "Edit Mahasiswa";
                        elseif ($p == 'hapus_mhs') echo "Hapus Mahasiswa";
                        elseif ($p == 'data_prodi') echo "Data Program Studi";
                        elseif ($p == 'create_prodi') echo "Tambah Program Studi";
                        elseif ($p == 'edit_prodi') echo "Edit Program Studi";
                        elseif ($p == 'hapus_prodi') echo "Hapus Program Studi";
                        else echo "Dashboard";
                        ?>
                    </h4>

                </div>
            </div>


            <div class="card content-card">
                <div class="card-body p-4">

                    <?php
                    $page = $_GET['p'] ?? "home";

                    switch ($page) {
                        case 'home':
                            include("home.php");
                            break;

                        case 'data_mhs':
                            include("mahasiswa/list.php");
                            break;
                        case 'create_mhs':
                            include("mahasiswa/create.php");
                            break;
                        case 'edit_mhs':
                            include("mahasiswa/gedit.php");
                            break;
                        case 'hapus_mhs':
                            include("mahasiswa/ghapus.php");
                            break;

                        case 'data_prodi':
                            include("program_studi/list.php");
                            break;
                        case 'create_prodi':
                            include("program_studi/create.php");
                            break;
                        case 'edit_prodi':
                            include("program_studi/gedit.php");
                            break;
                        case 'hapus_prodi':
                            include("program_studi/ghapus.php");
                            break;

                        default:
                            echo "<div class='alert alert-warning mb-0'>Halaman tidak ditemukan.</div>";
                            break;
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>

    <footer class="mt-auto bg-gray border-top">
        <div class="container py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-muted small">
                © <?= date("Y"); ?> Data Akademik Mahasiswa • All rights reserved.
            </div>
            <div class="text-muted small">
                Dibuat oleh <b>Zikri Ilham Pratama</b>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>