<?php
include "lib/koneksi.php";
include "lib/config.php";
include "pl-admin/lib/function.php";
session_start();
if (isset($_POST['login'])) {
    $email          = isValidate($_POST['email']);
    $kata_sandi     = isValidate(($_POST['kata_sandi']));

    $pesan_error    = "";
    $isEmail        = "";
    $isKataSandi    = "";

    $isEmail        = isEmpty($email, $isEmail);
    $isKataSandi    = isEmpty($kata_sandi, $isKataSandi);

    $email      = mysqli_real_escape_string($koneksi, $email);
    $kata_sandi = mysqli_real_escape_string($koneksi, $kata_sandi);

    // ubah kata sandi
    $kata_sandi_baru     = sha1($kata_sandi);

    $pladmin = mysqli_query($koneksi, "SELECT * FROM admin WHERE email='$email' AND kata_sandi='$kata_sandi_baru'");
    $cek    = mysqli_fetch_array($pladmin);
    $plmaskapai = mysqli_query($koneksi, "SELECT * FROM maskapai WHERE email='$email' AND kata_sandi='$kata_sandi_baru'");
    $cekmaskapai = mysqli_fetch_array($plmaskapai);
    $plpelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email='$email' AND kata_sandi='$kata_sandi_baru' && email_verified=1");
    $cekpelanggan = mysqli_fetch_array($plpelanggan);
    if (mysqli_num_rows($pladmin) == 1) {
        $id = $cek['id'];
        $_SESSION['id'] = $cek['id'];
        $_SESSION['nama'] = $cek['nama_lengkap'];
        $_SESSION['email'] = $cek['email'];
        $_SESSION['level'] = $cek['level'];
        $_SESSION['logged_time'] = time();
        $query = mysqli_query($koneksi, "UPDATE admin SET status='1' WHERE id='$id'");
        if (!isLoginSessionExpired()) {
            if ($query) {
                echo "<script src=\"https://unpkg.com/sweetalert/dist/sweetalert.min.js\"></script>";
                echo "
                <script type='text/javascript'>
                 setTimeout(function () { 
                 swal({
                            title: 'Sukses 😍',
                            text:  'Selamat kamu berhasil Login',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('pl-admin/index.php');
                 } ,3000); 
                </script>";
                // header("Location:pl-admin/index.php");
            }
        } else {
            header("Location:logout.php?session_expired=1");
        }
    } else if (mysqli_num_rows($plmaskapai) == 1) {
        $kode = $cekmaskapai['kode_penerbangan'];
        $_SESSION['kode'] = $cekmaskapai['kode_penerbangan'];
        $_SESSION['nama'] = $cekmaskapai['nama_maskapai'];
        $_SESSION['email'] = $cekmaskapai['email'];
        $_SESSION['level'] = $cekmaskapai['level'];
        $_SESSION['logged_time'] = time();
        $query = mysqli_query($koneksi, "UPDATE maskapai SET status='1' WHERE kode_penerbangan='$kode'");
        if (!isLoginSessionExpired()) {
            if ($query) {
                echo "<script src=\"https://unpkg.com/sweetalert/dist/sweetalert.min.js\"></script>";
                echo "
                <script type='text/javascript'>
                 setTimeout(function () { 
                 swal({
                            title: 'Sukses 😍',
                            text:  'Selamat kamu berhasil Login',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('pl-admin/index.php');
                 } ,3000); 
                </script>";
                // header("Location:pl-admin/index.php");
            }
        } else {
            header("Location:logout.php?session_expired=1");
        }
    } else if (mysqli_num_rows($plpelanggan) == 1) {
        $email = $cekpelanggan['email'];
        $nama   = $cekpelanggan['nama_lengkap'];
        $pisah  = explode(" ", $nama);
        $alias_depan = substr($pisah[0], 0, 1);
        $alias_belakang = substr($pisah[1], 0, 1);
        $_SESSION['id'] = $cekpelanggan['id'];
        $_SESSION['email'] = $cekpelanggan['email'];
        $_SESSION['nama_lengkap'] = $cekpelanggan['nama_lengkap'];
        $_SESSION['nama_depan'] = $pisah[0];
        $_SESSION['nama_belakang'] = $pisah[1];
        $_SESSION['ad'] = $alias_depan;
        $_SESSION['ab'] = $alias_belakang;
        $_SESSION['no_hp'] = $cekpelanggan['nomor_handphone'];
        $_SESSION['tanggal_lahir'] = $cekpelanggan['tanggal_lahir'];
        $_SESSION['level'] = $cekpelanggan['level'];
        $_SESSION['logged_time'] = time();
        $query = mysqli_query($koneksi, "UPDATE pelanggan SET status='1' WHERE email='$email'");
        if (!isLoginSessionExpired()) {
            if ($query) {
                echo "<script src=\"https://unpkg.com/sweetalert/dist/sweetalert.min.js\"></script>";
                echo "
                <script type='text/javascript'>
                 setTimeout(function () { 
                 swal({
                            title: 'Sukses 😍',
                            text:  'Selamat kamu berhasil Login',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('index.php');
                 } ,3000); 
                </script>";
                // header("Location:index.php");
            }
        } else {
            header("Location:logout.php?session_expired=1");
        }
    } else {
        $alert = "Username dan Password tidak cocok atau email belum verified";
    }
} else {
    $pesan_error = "";
    $email = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Plane.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- navbar -->
    <?php include "lib/navbar-login.php" ?>
    <!-- akhir navbar -->
    <!-- main -->
    <section class="main-login">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 my-3">
                    <div class="card border-0">
                        <img src="assets/images/background/bg_login.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-5 my-3">
                    <? if (isset($alert)) {
                    ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $alert;
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="card p-4 border-0 shadow-sm ">
                        <h4 class="fw-bold">Login</h4>
                        <p class="text-muted">Belum punya akun ? <a href="register.php" class="text-primary text-decoration-none">Daftar</a></p>
                        <form action="" method="POST" class="mt-3">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="email" class="form-control <?= $isEmail ?>" placeholder="Masukkan Email">
                                <label for="email">Email</label>
                                <div class="invalid-feedback">
                                    Email harus diisi
                                </div>
                                <div class="valid-feedback">
                                    Email Sudah diisi
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="kata_sandi" id="kata_sandi" class="form-control <?= $isKataSandi ?>" placeholder="Masukkan Kata Sandi">
                                <label for="kata_sandi">Password</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="reset-kata-sandi.php" class="text-decoration-none">Lupa Kata Sandi?</a>
                                <input type="submit" value="Login" name="login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer border-top">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4">
                    <img src="assets/images/logo/logo.png" alt="">
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-2">Location</h5>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima saepe repudiandae molestiae, veritatis nisi placeat voluptatum repellendus quas nostrum recusandae. Deserunt asperiores dicta voluptates nemo minus blanditiis consequatur officia in.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-2">Say Hello</h5>
                    <p>info@plane.com</p>

                </div>
            </div>
            <div class="row">
                <p class="text-center">Copyright 2021 All Right Reserved | By <span class="text-primary">Plane.com</span></p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


</body>

</html>