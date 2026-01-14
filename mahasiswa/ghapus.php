<?php

include("../koneksi.php");
$sql = "DELETE FROM mahasiswa WHERE nim='$_GET[nim]'";
$query = $koneksi->query($sql); //eksekusi query
if ($query) {
    echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = '../index.php?p=data_mhs';  
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus!');
        window.location.href = '../index.php?p=data_mhs';  
        </script>";
}
