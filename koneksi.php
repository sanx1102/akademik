<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "db_akademik";
$koneksi = new mysqli($host, $user, $password, $db);

if ($koneksi->connect_error) {
    echo "Koneksi gagal!";
}
