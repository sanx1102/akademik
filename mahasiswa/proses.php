<?php
//include |require|include_once|require_once
require '../koneksi.php';

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];


    $sql = "INSERT INTO mahasiswa(nim,nama,tgl_lahir,alamat,id_prodi)
            Values ('$nim','$nama','$tanggal','$alamat','$prodi')";
    $query = $koneksi->query($sql); //eksekusi query

    if ($query) {
        echo "<script>
                alert('Berhasil menyimpan data');
                window.location.href = '../index.php?p=data_mhs';
              </script>";
    } else {
        echo "Gagal menyimpan data";
    }
}
