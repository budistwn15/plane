<?php
if ($_SESSION['level'] == "admin") {
    if (isset($_GET['kode_penerbangan'])) {
        $kode_penerbangan = $_GET['kode_penerbangan'];
        $query = deleteData($koneksi, "maskapai", "kode_penerbangan", $kode_penerbangan);

        redirectURLMessage($query, "maskapai", "Data maskapai berhasil di hapus");
    }
} else {
    header("Location: index.php");
}
