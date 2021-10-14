<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT MAX(kode_pesanan) as kodeTerbesar FROM transaksi");
$data = mysqli_fetch_array($query);
$kode_pesanan = $data['kodeTerbesar'];

$urutan = (int) substr($kode_pesanan, 14, 14);
$urutan++;

$huruf = "PL";
$kode_pesanan = $huruf . sprintf("%014s", $urutan);
