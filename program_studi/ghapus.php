<?php

include("../koneksi.php");
$sql = "DELETE FROM program_studi WHERE id='$_GET[id]'";
$query = $koneksi->query($sql);
if ($query) {
    header("location:../index.php?p=data_prodi");
} else {
    echo "Gagal menghapus data";
}
