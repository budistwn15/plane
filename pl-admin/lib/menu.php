<?php
include "../lib/koneksi.php";

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = "dashboard";
}

switch ($menu) {
    case "dashboard":
        include "dashboard.php";
        break;
        // Maskapai
    case "maskapai":
        include "maskapai/lihat.php";
        break;
    case "maskapai-tambah":
        include "maskapai/tambah.php";
        break;
    case "maskapai-hapus":
        include "maskapai/hapus.php";
        break;
    case "maskapai-edit":
        include "maskapai/edit.php";
        break;
        // pelanggan
    case "pelanggan":
        include "pelanggan/lihat.php";
        break;
    case "pelanggan-hapus":
        include "pelanggan/hapus.php";
        break;
        // jadwal
    case "jadwal":
        include "jadwal/lihat.php";
        break;
    case "jadwal-tambah":
        include "jadwal/tambah.php";
        break;
    case "jadwal-edit":
        include "jadwal/edit.php";
        break;
    case "jadwal-hapus":
        include "jadwal/hapus.php";
        break;
        // Transaksi
    case "transaksi":
        include "transaksi/lihat.php";
        break;
    case "transaksi-detail":
        include "transaksi/detail.php";
        break;
    case "konfirmasi":
        include "konfirmasi/lihat.php";
        break;
    case "konfirmasi-pesanan":
        include "konfirmasi/konfirmasi-pesanan.php";
        break;
    case "laporan":
        include "laporan/lihat.php";
        break;
    case "profile":
        include "profile/lihat.php";
        break;
    case "profile-edit":
        include "profile/edit.php";
        break;
    default:
        include "dashboard.php";
        break;
}
