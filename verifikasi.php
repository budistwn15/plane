<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Plane.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <!-- navbar -->
    <?php include "lib/navbar-login.php" ?>
    <!-- akhir navbar -->
    <!-- main -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <img src="assets/images/background/mail.png" class="rounded mx-auto d-block" alt="" srcset="" width="450">
                <h2 class="fw-bold text-center mt-3">Harap Verifikasi Akun</h2>
                <p class="text-muted text-center">Pendaftaran anda berhasil, silahkan cek email anda untuk aktivasi</p>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn btn-primary" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>