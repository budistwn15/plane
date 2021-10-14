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
                        <img src="assets/images/background/Res.png" alt="" width="300" class="mx-auto d-block">
                        <h4 class="fw-bold text-center">Sukses</h4>
                        <p class="text-muted text-center">Anda telah berhasil mengganti kata sandi</p>
                        <a href="login.php" class="btn btn-primary m-auto">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>