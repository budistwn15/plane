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
    <div class="container">
        <?php
        include "lib/koneksi.php";
        $token = $_GET['t'];
        $sql_cek = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE token='" . $token . "' and email_verified='0'");
        $jml_data = mysqli_num_rows($sql_cek);
        if ($jml_data > 0) {
            //update data users aktif
            mysqli_query($koneksi, "UPDATE pelanggan SET email_verified='1' WHERE token='" . $token . "' and email_verified='0'");
            echo "
            <div class=\"row\">
            <div class=\"col-md-6 mx-auto\">
                <img src=\"assets/images/background/verified.png\" class=\"rounded mx-auto d-block\" alt=\"\" srcset=\"\" width=\"450\">
                <h2 class=\"fw-bold text-center mt-3\">Terverifikasi</h2>
                <p class=\"text-muted text-center\">Anda telah berhasil memverifikasi alamat email anda</p>
                <div class=\"d-grid gap-2 col-6 mx-auto\">
                    <a class=\"btn btn-primary\" href=\"login.php\">Login</a>
                </div>
            </div>
        </div>
            ";
        } else {
            echo "
            <div class=\"row\">
            <div class=\"col-md-6 mx-auto\">
                <img src=\"assets/images/background/gagal.png\" class=\"rounded mx-auto d-block\" alt=\"\" srcset=\"\" width=\"450\">
                <h2 class=\"fw-bold text-center mt-3\">Token Invalid</h2>
                <p class=\"text-muted text-center\">Gagal memverifikasi alamat email anda.</p>
                <div class=\"d-grid gap-2 col-6 mx-auto\">
                    <a class=\"btn btn-primary\" href=\"login.php\">Login</a>
                </div>
            </div>
        </div>
            ";
        }
        ?>

    </div>
    <!-- akhir navbar -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>