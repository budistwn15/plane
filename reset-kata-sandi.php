<?php
if (isset($_POST['reset'])) {
    include "lib/koneksi.php";
    include "pl-admin/lib/function.php";
    $email = isValidate($_POST['email']);

    $isEmail = "";
    $isEmail = isEmpty($email, $isEmail);

    $email = mysqli_real_escape_string($koneksi, $email);

    $cek = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email='$email'");
    $data = mysqli_fetch_assoc($cek);

    if (mysqli_num_rows($cek) == 1) {
        $pesan = "Kami telah mengirim link reset kata sandi ke email anda";
        include "mail-reset.php";
    } else {
        $pesan_error = "Email yang anda masukkan salah. Mohon maaf email anda tidak terdaftar d website kami";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi | Plane.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <!-- navbar -->
    <?php
    include('lib/navbar-login.php');
    ?>
    <!-- akhir navbar -->

    <!-- main -->
    <section class="main-login">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 m-auto">
                    <div class="card p-4 border-0 shadow-sm">
                        <img src="assets/images/background/lupa password.png" alt="" width="300" class="mx-auto d-block">
                        <h4 class="fw-bold text-center">Reset Kata Sandi</h4>
                        <p class="text-muted text-center">Jangan khawatir! Cukup ketik email anda dan kami akan mengirimkan link untuk mengatur ulang kata sandi anda</p>
                        <?php
                        if (isset($pesan)) {
                            echo "<div class=\"alert alert-success\">$pesan</div>";
                        } else if (isset($pesan_error)) {
                            echo "<div class=\"alert alert-danger\">$pesan_error</div>";
                        }
                        ?>
                        <form action="" method="POST" class="was-validate mt-3">
                            <div class="form-floating mb-4">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email">
                                <label for="email">Email</label>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" value="Minta Link Reset" class="btn btn-primary" name="reset">
                                <p class="text-center text-muted">Kembali ke halaman <a href="login.php" class="text-decoration-none">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>