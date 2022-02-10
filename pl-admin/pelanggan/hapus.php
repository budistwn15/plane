<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = deleteData($koneksi, "pelanggan", "id", $id);
    redirectURLMessage($query, "pelanggan", "Pelanggan Berhasil Dihapus");
} else {
    header("Location:index.php?menu=pelanggan");
}
