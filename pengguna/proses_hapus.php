<?php
session_start();
require "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_POST['hapus'])) {
    header("Location: profil.php");
    exit();
}

$id = $_SESSION['id'] ?? 0;
$password = $_POST['password'] ?? "";

if (!$id || $password === "") {
    echo "<script>alert('Password wajib diisi!'); window.location.href='profil.php';</script>";
    exit();
}

// ambil user
$stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location.href='../index.php';</script>";
    exit();
}

// cek password
if (!password_verify($password, $user['password'])) {
    echo "<script>alert('Password salah! Akun tidak dihapus.'); window.location.href='profil.php';</script>";
    exit();
}

// hapus akun
$del = $koneksi->prepare("DELETE FROM pengguna WHERE id = ?");
$del->bind_param("i", $id);

if ($del->execute()) {
    session_destroy();
    echo "<script>alert('Akun berhasil dihapus.'); window.location.href='../login.php';</script>";
    exit();
} else {
    echo "<script>alert('Gagal menghapus akun!'); window.location.href='profil.php';</script>";
    exit();
}
