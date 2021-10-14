<?php
include "lib/koneksi.php";
session_start();
if (isset($_SESSION['id']) || isset($_SESSION['kode'])) {
    if ($_SESSION['level'] == "admin") {
        $id = $_SESSION['id'];
        $query = mysqli_query($koneksi, "UPDATE admin SET status='0' WHERE id='$id'");
        unset($_SESSION['id']);
        unset($_SESSION['nama']);
        unset($_SESSION['email']);
        unset($_SESSION['level']);
        $url = "index.php";
        session_unset();
        session_destroy();
    } else if ($_SESSION['level'] == "maskapai") {
        $kode = $_SESSION['kode'];
        $query = mysqli_query($koneksi, "UPDATE maskapai SET status='0' WHERE kode_penerbangan='$kode'");
        unset($_SESSION['kode']);
        unset($_SESSION['nama']);
        unset($_SESSION['email']);
        unset($_SESSION['level']);
        $url = "index.php";
        session_unset();
        session_destroy();
    } else if ($_SESSION['level'] == "pelanggan") {
        $email = $_SESSION['email'];
        $query = mysqli_query($koneksi, "UPDATE pelanggan SET status='0' WHERE email='$email'");
        unset($_SESSION['email']);
        unset($_SESSION['nama_lengkap']);
        unset($_SESSION['no_hp']);
        unset($_SESSION['nama_lengkap']);
        unset($_SESSION['nama_depan']);
        unset($_SESSION['nama_belakang']);
        unset($_SESSION['ad']);
        unset($_SESSION['tanggal_lahir']);
        unset($_SESSION['level']);
        $url = "index.php";
        session_unset();
        session_destroy();
    }
    if ($query) {
        if (isset($_GET["session_expired"])) {
            $url .= "?session_expired=" . $_GET['session_expired'];
        }
    }
    echo "<script src=\"https://unpkg.com/sweetalert/dist/sweetalert.min.js\"></script>";
    echo "
                <script type='text/javascript'>
                 setTimeout(function () { 
                 swal({
                            title: 'Sukses 😍',
                            text:  'Selamat kamu berhasil Logout',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('$url');
                 } ,2500); 
                </script>";
} else {
    header("Location:index.php");
}
