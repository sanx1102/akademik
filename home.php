<?php

if (isset($_SESSION['nama']) && !empty($_SESSION['nama'])) {
    echo "<h1>Selamat Datang,  " . htmlspecialchars($_SESSION['nama']);
} else {
    echo "Selamat Datang, Pengguna";
}
