<?php
if (isset($_POST['proses'])) {
    $kode_pesanan = isValidate($_POST['kode_pesanan']);
    $id = isValidate($_POST['id']);
    $id_pelanggan = $_SESSION['id'];
    $nama_depan = isValidate($_POST['nama_depan']);
    $nama_belakang = isValidate($_POST['nama_belakang']);

    $nama_lengkap = $nama_depan . " " . $nama_belakang;

    $kategori = isValidate($_POST['kategori']);
    $jenis_kelamin = isValidate($_POST['jenis_kelamin']);
    $kode_negara = isValidate($_POST['kode_negara']);
    $no_handphone = isValidate($_POST['no_handphone']);
    $email_transaksi = isValidate($_POST['email_transaksi']);

    $pernyataan = isValidate($_POST['pernyataan']);

    $tarif_dasar = isValidate($_POST['tarif_dasar']);
    $biaya_tambahan = isValidate($_POST['biaya_tambahan']);
    $amal = isValidate($_POST['amal']);
    $jumlah_total = isValidate($_POST['jumlah_total']);
    $keterangan = "Belum";

    $timestamp      = date('Y-m-d');
    // filterdata
    $kode_pesanan = mysqli_real_escape_string($koneksi, $kode_pesanan);
    $id = mysqli_real_escape_string($koneksi, $id);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $nama_lengkap);
    $kategori = mysqli_real_escape_string($koneksi, $kategori);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $jenis_kelamin);
    $kode_negara = mysqli_real_escape_string($koneksi, $kode_negara);
    $no_handphone = mysqli_real_escape_string($koneksi, $no_handphone);
    $email_transaksi = mysqli_real_escape_string($koneksi, $email_transaksi);
    $pernyataan = mysqli_real_escape_string($koneksi, $pernyataan);
    $tarif_dasar = mysqli_real_escape_string($koneksi, $tarif_dasar);
    $biaya_tambahan = mysqli_real_escape_string($koneksi, $biaya_tambahan);
    $amal = mysqli_real_escape_string($koneksi, $amal);
    $jumlah_total = mysqli_real_escape_string($koneksi, $jumlah_total);
    $keterangan = mysqli_real_escape_string($koneksi, $keterangan);
    // tambah data
    $query = mysqli_query($koneksi, "INSERT INTO transaksi VALUES('$kode_pesanan','$id','$id_pelanggan','$timestamp','$nama_lengkap','$kategori','$jenis_kelamin','$kode_negara','$no_handphone','$email_transaksi','$pernyataan','$tarif_dasar','$biaya_tambahan','$amal','$jumlah_total','$keterangan')");

    if ($query) {
        header("Location: index.php?menu=pembayaran&kode_pesanan=$kode_pesanan");
    }
} else {
    header("Location:index.php");
}
