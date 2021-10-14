<?php
if (isset($_POST['simpan'])) {
    $id = isValidate($_POST['id']);
    $nama_depan = isValidate($_POST['nama_depan']);
    $nama_belakang = isValidate($_POST['nama_belakang']);
    $tanggal_lahir = isValidate($_POST['tanggal_lahir']);

    // filter data
    $nama_depan = mysqli_real_escape_string($koneksi, $nama_depan);
    $nama_belakang = mysqli_real_escape_string($koneksi, $nama_belakang);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $tanggal_lahir);

    $nama_lengkap = $nama_depan . " " . $nama_belakang;
    $nama_lengkap = mysqli_real_escape_string($koneksi, $nama_lengkap);

    $query = mysqli_query($koneksi, "UPDATE pelanggan SET nama_lengkap='$nama_lengkap',tanggal_lahir='$tanggal_lahir' WHERE id='$id'");

    if ($query) {
        $pesan = "Berhasil merubah profile";
        $pesan = urlencode($pesan);
        header("Location:index.php?menu=profile&pesan={$pesan}");
    }
}
