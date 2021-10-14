<?php
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = "beranda";
}

switch ($menu) {
    case "beranda":
        include "beranda.php";
        break;
    case "bantuan":
        include "bantuan.php";
        break;
    case "kontak":
        include "kontak.php";
        break;
    case "profile":
        include "profile.php";
        break;
    case "profile-edit":
        include "profile-edit.php";
        break;
    case "ganti-kata-sandi":
        include "ganti-kata-sandi.php";
        break;
    case "ganti-kata-sandi-proses":
        include "ganti-kata-sandi-proses.php";
        break;
    case "pesanan":
        include "pesanan.php";
        break;
    case "detail":
        include "detail.php";
        break;
    case "detail-form":
        include "detail_form.php";
        break;
    case "detail-form-proses":
        include "detail-form-proses.php";
        break;
    case "pembayaran":
        include "pembayaran.php";
        break;
    case "pembayaran-detail":
        include "pembayaran_detail.php";
        break;
    case "pembayaran-kode":
        include "pembayaran_kode.php";
        break;
    case "konfirmasi-pembayaran":
        include "konfirmasi-pembayaran.php";
        break;
    case "e-ticket":
        include "e-ticket.php";
        break;
}
