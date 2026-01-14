<?php
//include |require|include_once|require_once
require '../koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jenjang = $_POST['jenjang'];
    $akreditasi = $_POST['akreditasi'];
    $keterangan = $_POST['keterangan'];


    $sql = "INSERT INTO program_studi(nama_prodi,jenjang,akreditasi,keterangan)
            Values ('$nama','$jenjang','$akreditasi','$keterangan')";
    $query = $koneksi->query($sql); //eksekusi query

    if ($query) {
        echo "<script>
                alert('Berhasil menyimpan data');
                window.location.href = '../index.php?p=data_prodi';
              </script>";
    } else {
        echo "Gagal menyimpan data";
    }
}
