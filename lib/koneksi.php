<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_plane");
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
