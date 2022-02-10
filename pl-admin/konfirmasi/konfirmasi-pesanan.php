<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id_pelanggan = $_GET['pelanggan'];
    $update             = date('Y-m-d H:i:s');
    $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pelanggan='$id_pelanggan'");
    $data = mysqli_fetch_array($transaksi);
    $query = mysqli_query($koneksi, "UPDATE pembayaran SET keterangan='1', update_at='$update' WHERE id='$id'");

    include "../mail-ticket.php";
    if ($query) {
        header("Location:index.php?menu=konfirmasi");
    } else {
        header("Location:index.php?menu=konfirmasi");
    }
} else {
    header("Location:index.php");
}
