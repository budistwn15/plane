<?php
if (isset($_POST['tampilkan'])) {
    include "../../lib/koneksi.php";
    include "../../lib/config.php";

    $dari       = date('Y-m-d', strtotime($_POST['dari']));
    $sampai     = date('Y-m-d', strtotime($_POST['sampai']));

    $query = mysqli_query($koneksi, "SELECT * FROM transaksi  WHERE tanggal BETWEEN '" . $dari . "' AND '" . $sampai . "' ORDER BY kode_pesanan ASC");
    $jumlah = mysqli_num_rows($query);

    $url_plane = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/$dari";
    $waktu = date('H:i:s a');
    $tanggal = date("Y-m-d");
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Plane adalah website untuk memesan tiket pesawat">
        <meta name="author" content="Budi Setiawan">
        <title>Laporan - Plane</title>
        <link rel="shortcut icon" href="../../assets/images/logo/Icon-Logo.png">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="row my-4">
                <p><?= $waktu . "  " . $tanggal . "  " . $url_plane; ?></p>
            </div>
            <section class="navbar-login">
                <nav class="navbar navbar-expand-sm navbar-light bg-white">
                    <div class="container">
                        <a class="navbar-brand m-auto" href="index.php">
                            <img src="../../assets/images/logo/logo.png" alt="">
                        </a>
                    </div>
                </nav>
            </section>
            <div class="row text-center">
                <h4 class="fw-bold">SEMUA TRANSAKSI</h4>
                <p>Berikut dibawah ini merupakan laporan dari tanggal <span class="text-primary"><?= $dari; ?></span> sampai <span class="text-primary"><?= $sampai; ?></span></p>
                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Bayar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($jumlah > 0) {
                                foreach ($query as $data) {
                            ?>
                                    <tr>
                                        <td><?= $data['kode_pesanan']; ?></td>
                                        <td><?= $data['tanggal']; ?></td>
                                        <td><?= $data['nama_lengkap']; ?></td>
                                        <td><?= $data['jumlah_total']; ?></td>
                                        <td><?= $data['keterangan']; ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger">Data Tidak Tersedia</div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                if ($jumlah > 0) {
                ?>
                    <div class="d-flex justify-content-end">
                        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>

<?php
} else {
    header("Location:index.php");
}
?>