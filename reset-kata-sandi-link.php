<?php
if (isset($_GET['id'])) {
    include "lib/koneksi.php";
    include "pl-admin/lib/function.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'");
    $data = mysqli_fetch_array($query);

    if (isset($_POST['reset'])) {
        $email = isValidate($_POST['email']);
        $kata_sandi_baru = isValidate($_POST['kata_sandi_baru']);
        $konfirmasi_kata_sandi_baru = isValidate($_POST['konfirmasi_kata_sandi_baru']);
        $update             = date('Y-m-d H:i:s');

        $kata_sandi_baru = sha1($kata_sandi_baru);
        $konfirmasi_kata_sandi_baru = sha1($konfirmasi_kata_sandi_baru);

        // filter data
        $email = mysqli_real_escape_string($koneksi, $email);
        $kata_sandi_baru = mysqli_real_escape_string($koneksi, $kata_sandi_baru);
        $konfirmasi_kata_sandi_baru = mysqli_real_escape_string($koneksi, $konfirmasi_kata_sandi_baru);

        if ($kata_sandi_baru == $konfirmasi_kata_sandi_baru) {
            $reset = mysqli_query($koneksi, "UPDATE pelanggan SET kata_sandi='$kata_sandi_baru',updated_at='$update' WHERE id='$id'");
            if ($reset) {
                header("Location:reset-kata-sandi-berhasil.php");
            } else {
                $pesan = "Gagal Merubah Kata Sandi";
            }
        } else {
            $pesan = "Kata Sandi Tidak Cocok";
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
                            <p class="text-muted text-center">Silahkan masukkan kata sandi baru yang menurut anda lebih aman dan mudah diingat</p>
                            <?php
                            if (isset($pesan)) {
                                echo "<div class=\"alert alert-danger\">$pesan</div>";
                            }
                            ?>
                            <form action="" method="POST" class="was-validate mt-3">
                                <div class="form-floating mb-4">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" value="<?= $data['email'] ?>" readonly>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="kata_sandi_baru" id="kata_sandi_baru" class="form-control" placeholder="Masukkan Kata Sandi Baru" required>
                                    <label for="kata_sandi_lama">Kata Sandi Baru</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="konfirmasi_kata_sandi_baru" id="konfirmasi_kata_sandi_baru" class="form-control" placeholder="Konfirmasi Kata Sandi Baru" required>
                                    <label for="kata_sandi_baru">Konfirmasi Kata Sandi Baru</label>
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
<?php
} else {
    header("Location: index.php");
}
?>