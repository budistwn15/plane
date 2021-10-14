<?php
include('lib/koneksi.php');
include('pl-admin/lib/function.php');
$data_negara = "json/negara.json";
$file   = file_get_contents($data_negara);
$data   = json_decode($file, true);
if (isset($_POST['daftar'])) {
    $email          = isValidate($_POST['email']);
    $nama_depan     = isValidate($_POST['nama_depan']);
    $nama_belakang  = isValidate($_POST['nama_belakang']);
    $kata_sandi     = isValidate($_POST['kata_sandi']);
    $tanggal_lahir  = isValidate($_POST['tanggal_lahir']);
    $no_handphone   = isValidate($_POST['no_handphone']);
    $negara         = isValidate($_POST['negara']);
    $timestamp      = date('Y-m-d H:i:s');

    $isEmail         = "";
    $isNamaDepan     = "";
    $isNamaBelakang  = "";
    $isKataSandi     = "";
    $isTanggalLahir  = "";
    $isNoHandphone   = "";
    $isNegara    = "";

    $isEmail         = isEmpty($email, $isEmail);
    $isNamaDepan     = isEmpty($nama_depan, $isNamaDepan);
    $isNamaBelakang  = isEmpty($nama_belakang, $isNamaBelakang);
    $isKataSandi     = isEmpty($kata_sandi, $isKataSandi);
    $isTanggalLahir  = isEmpty($tanggal_lahir, $isTanggalLahir);
    $isNoHandphone   = isEmpty($no_handphone, $isNoHandphone);
    $isNegara    = isEmpty($negara, $isNegara);

    //hashing
    $kata_sandi_baru = sha1($kata_sandi);

    //gabung nama depan dan nama belakang
    $nama_lengkap = $nama_depan . " " . $nama_belakang;

    //filter semua data
    $email              = mysqli_real_escape_string($koneksi, $email);
    $nama_lengkap       = mysqli_real_escape_string($koneksi, $nama_lengkap);
    $kata_sandi_baru    = mysqli_real_escape_string($koneksi, $kata_sandi_baru);
    $tanggal_lahir      = mysqli_real_escape_string($koneksi, $tanggal_lahir);
    $no_handphone       = mysqli_real_escape_string($koneksi, $no_handphone);
    $negara             = mysqli_real_escape_string($koneksi, $negara);
    // token
    $token = hash('sha256', md5(date('Y-m-d')));

    // cek email
    $cek_data   = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email='$email'");
    $cek        = mysqli_num_rows($cek_data);
    if ($cek > 0) {
        $alert = "Email anda sudah pernah terdaftar !";
    } else {
        $query = createData($koneksi, "pelanggan", [
            'id' => NULL,
            'email' => $email,
            'nama_lengkap' => $nama_lengkap,
            'kata_sandi' => $kata_sandi_baru,
            'tanggal_lahir' => $tanggal_lahir,
            'nomor_handphone' => $no_handphone,
            'negara' => $negara,
            'status' => 0,
            'token' => $token,
            'email_verified' => 0,
            'level' => "pelanggan",
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);
        include "mail.php";
        if ($query) {
            header("Location:verifikasi.php");
        }
    }
} else {
    $email          = "";
    $nama_depan     = "";
    $nama_belakang  = "";
    $kata_sandi     = "";
    $tanggal_lahir  = "";
    $no_handphone   = "";
    $negara    = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Plane.com</title>
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
                <div class="col-md-6 my-3">
                    <div class="card border-0">
                        <img src="assets/images/background/bg_login.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-5 my-3">
                    <?php
                    if (isset($alert)) {
                    ?>
                        <div class="alert alert-danger my-2">
                            <?php
                            echo $alert;
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="card p-4 border-0 shadow-sm">
                        <h4 class="fw-bold">Daftar</h4>
                        <p class="text-muted">Sudah punya akun ? <a href="login.php" class="text-primary text-decoration-none">Masuk</a></p>
                        <form action="" method="POST" class="was-validate mt-3">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="email" class="form-control <?= $isEmail ?>" placeholder="Masukkan Email" value="<?= $email ?>">
                                <label for="email">Email</label>
                            </div>
                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_depan" id="nama_depan" class="form-control <?= $isNamaDepan ?>" placeholder="Masukkan Nama Depan" value="<?= $nama_depan ?>">
                                        <label for="nama_depan">Nama Depan</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_belakang" id="nama_belakang" class="form-control <?= $isNamaBelakang ?>" placeholder="Masukkan Nama Belakang">
                                        <label for="nama_belakang">Nama Belakang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="kata_sandi" id="kata_sandi" class="form-control <?= $isKataSandi ?>" placeholder="Masukkan Kata Sandi" value="<?= $kata_sandi ?>">
                                <label for="">Kata Sandi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control <?= $isTanggalLahir ?>" placeholder="Masukkan Tanggal Lahir">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" name="no_handphone" id="no_hanpdhone" class="form-control <?= $isNoHandphone ?>" placeholder="Masukkan No Handphone">
                                <label for="no_handphone">No Handphone</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="negara" id="negara" class="form-select <?= $isNegara ?>">
                                    <?php
                                    foreach ($data as $row) {
                                    ?>
                                        <option value="<?= $row['name'] ?>"><?= "(" . $row['code'] . ") " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="negara">Negara</label>
                            </div>
                            <div class="mb-3">
                                <p class="text-muted">Dengan mengklik daftar, saya setuju bahwa saya telah membaca dan menerima <a href="#" class="text-decoration-none">Persyaratan Penggunaan</a>dan <a href="#" class="text-decoration-none">Kebijakan Privasi</a></p>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="submit" value="Daftar" class="btn btn-primary" name="daftar">
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
</body>

</html>