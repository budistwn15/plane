<?php
$bandara    = "json/bandara.json";
$file       = file_get_contents($bandara);
$data_bandara       = json_decode($file, true);
if (isset($_POST['cari'])) {
    include "lib/koneksi.php";
    include "pl-admin/lib/function.php";
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <!-- css -->
        <link rel="stylesheet" href="assets/css/dark-mode.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Plane.com</title>
    </head>

    <body>
        <?php
        session_start();
        ?>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/images/logo/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITEURLMENU ?>bantuan">Bantuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITEURLMENU ?>kontak">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <div class="form-check form-switch my-2 mx-2">
                                <input type="checkbox" class="form-check-input" id="darkSwitch">
                                <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                            </div>
                        </li>
                        <?php
                        if (isset($_SESSION['level']) == "pelanggan") {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">My Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Inbox</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= SITEURLMENU ?>profile" class="btn btn-primary rounded-circle ms-2"><?= strtolower($_SESSION['ad']) . strtolower($_SESSION['ab']); ?></a>
                            </li>
                        <?php
                        } else if (isset($_SESSION['level']) == "") {
                        ?>
                            <!-- desktop -->
                            <form class="d-flex d-none d-md-block">
                                <a href="login.php" class="btn btn-primary btn-navbar-right ms-4">Login</a>
                                <a href="register.php" class="btn btn-outline-primary btn-navbar-right ms-2">Daftar</a>
                            </form>
                            <!-- mobile -->
                            <form class="d-grid gap-2 d-sm-block d-md-none">
                                <button class="btn btn-primary">Login</button>
                                <button class="btn btn-outline-primary">Daftar</button>
                            </form>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- akhir navbar -->
        <div class="container">
            <div class="row">
                <form action="search.php" method="POST">
                    <div class="col-md-12">
                        <ul class="list-group list-group-horizontal-lg border py-3 ">
                            <div class="col-md-2">
                                <li class="list-group-item border-0">
                                    <div class="form-floating">
                                        <select name="perjalanan" id="perjalanan" class="form-select border-warning border-0 border-start border-4">
                                            <option value="Sekali Jalan">Sekali Jalan</option>
                                            <option value="Transit">Transit</option>
                                        </select>
                                        <label for="perjalanan">Perjalanan</label>
                                    </div>
                                </li>
                            </div>
                            <div class="col-md-2">
                                <li class="list-group-item border-0">
                                    <div class="form-floating">
                                        <select name="dari" id="dari" class="form-select border-warning border-0 border-start border-4">
                                            <?php
                                            sort($data_bandara);
                                            foreach ($data_bandara as $dari) { ?>
                                                <option value="<?= $dari['kode'] ?>"><?= $dari['kota'] . " - " . $dari['kode']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="dari">Dari</label>
                                    </div>
                                </li>
                            </div>
                            <div class="col-md-2">
                                <li class="list-group-item border-0">
                                    <div class="form-floating">
                                        <select class="form-select border-warning border-0 border-start border-4" id="ke" name="ke" aria-label="Floating label select example">
                                            <?php
                                            rsort($data_bandara);
                                            foreach ($data_bandara as $ke) { ?>
                                                <option value="<?= $ke['kode'] ?>"><?= $ke['kota'] . " - " . $ke['kode']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="dari">Ke</label>
                                    </div>
                                </li>
                            </div>
                            <div class="col-md-3">
                                <li class="list-group-item border-0">
                                    <div class="form-floating">
                                        <input type="date" name="keberangkatan" id="keberangkatan" class="form-control border-0 border-start border-warning border-4" placeholder="Masukkan Tanggal">
                                        <label for="keberangkatan">Berangkat</label>
                                    </div>
                                </li>
                            </div>
                            <div class="col-md-3">
                                <li class="list-group-item border-0">
                                    <div class="form-floating">
                                        <input type="date" name="kedatangan" id="kedatangan" class="form-control border-0 border-start border-warning border-4" placeholder="Masukkan Tanggal">
                                        <label for="kedatangan">Pulang</label>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </div>
            </div>
            <div class="row" style="margin-top: -15px;">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" style="border-radius: 20px;" value="Ubah Pencarian" name="cari">
                </div>
                </form>
            </div>
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card bg-white border-0 p-4">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Penerbangan</th>
                                        <th>Keberangkatan</th>
                                        <th>Durasi</th>
                                        <th>Kedatangan</th>
                                        <th>Jumlah Kursi</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['dari']) && isset($_POST['ke']) && isset($_POST['keberangkatan']) && isset($_POST['kedatangan'])) {
                                        $dari           = $_POST['dari'];
                                        $ke             = $_POST['ke'];
                                        $keberangkatan  = $_POST['keberangkatan'];
                                        $kedatangan     = $_POST['kedatangan'];
                                        $data = mysqli_query($koneksi, "SELECT * FROM jadwal JOIN maskapai ON maskapai.kode_penerbangan=jadwal.kode_penerbangan WHERE dari like '%" . $dari . "%' AND ke LIKE '%" . $ke . "%' AND keberangkatan LIKE '%" . $keberangkatan . "%' AND kedatangan LIKE '%" . $kedatangan . "%'");
                                        $jumlah = mysqli_num_rows($data);
                                    } else {
                                        $data = mysqli_query($koneksi, "SELECT * FROM jadwal");
                                    }
                                    if ($jumlah > 0) {
                                        foreach ($data as $d) {
                                            $awal = date_create($d['jam_keberangkatan']);
                                            $akhir = date_create($d['jam_kedatangan']);
                                            $diff = date_diff($awal, $akhir);
                                    ?>
                                            <tr>
                                                <td><?= "<img src='assets/images/logo/maskapai/" . $d['logo'] . "'width='50'" ?>
                                                </td>
                                                <td class="align-middle"><?= $d['nama_maskapai']; ?></td>
                                                <td class="align-middle"><strong><?= $d['jam_keberangkatan']; ?></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?php
                                                        foreach ($data_bandara as $bandara_dari) {
                                                            if ($bandara_dari['kode'] == $d['dari'])
                                                                echo $bandara_dari['kota'];
                                                        }
                                                        ?>
                                                    </small>
                                                </td>
                                                <td class="align-middle"><?= $diff->h . " jam " . $diff->i . " menit "; ?>
                                                </td>
                                                <td class="align-middle"><strong><?= $d['jam_kedatangan']; ?></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?php
                                                        foreach ($data_bandara as $bandara_ke) {
                                                            if ($bandara_ke['kode'] == $d['ke'])
                                                                echo $bandara_ke['kota'];
                                                        }
                                                        ?>
                                                    </small>
                                                </td>
                                                <td class="align-middle">
                                                    <?php
                                                    if ($d['jumlah_kursi'] > 0) {
                                                    ?>
                                                        <?= $d['jumlah_kursi']; ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="text-danger">Kursi Kosong</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="align-middle">
                                                    <strong>Rp. <?= number_format($d['total_harga'], "0", ".", ".") ?></strong>
                                                </td>
                                                <td class="align-middle">
                                                    <?php
                                                    if ($d['jumlah_kursi'] > 0) {
                                                    ?>
                                                        <a href="index.php?menu=detail&id=<?= $d['id'] ?>" class="btn btn-primary" style="border-radius: 20px;">Pilih</a>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            Kami mohon maaf tidak ada penerbangan yang kamu cari
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="assets/js/dark-mode-switch.min.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:index.php");
}
?>