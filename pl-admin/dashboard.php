<!-- breadcrumb -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Dashboard</h1>
</div>
<div class="row">

    <?php
    if ($_SESSION['level'] == 'admin') {
    ?>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-auto">
                    <div class="card p-4 text-white" style="background-color:#2E4DD4 !important;border-radius: 20px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="fw-bold">Hello <?= $_SESSION['nama']; ?>!</h5>
                                <p class="fw-lighter">Selamat datang di halaman admin plane.com Semoga harimu menyenangkan</p>
                            </div>
                            <div class="col-md-4">
                                <img src="../assets/images/background/dashboard.png" alt="Dashboard" class="img-responsive col-md-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4 text-white" style="background-color:#FFC425 !important;border-radius: 20px;">
                        <?php
                        $hitung_maskapai    = mysqli_query($koneksi, "SELECT * FROM maskapai");
                        $jml_maskapai       = mysqli_num_rows($hitung_maskapai);
                        ?>
                        <div class="card-body">
                            <div class="row nu-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-cs fw-bold text-uppercase mb-1">Maskapai</div>
                                    <div class="h5 mb-0 fw-bold"><?= $jml_maskapai; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-plane fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4 text-white" style="background-color:#000000 !important;border-radius: 20px;">
                        <?php
                        $hitung_penerbangan    = mysqli_query($koneksi, "SELECT * FROM jadwal");
                        $jml_penerbangan       = mysqli_num_rows($hitung_penerbangan);
                        ?>
                        <div class="card-body">
                            <div class="row nu-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-cs fw-bold text-uppercase mb-1">Penerbangan</div>
                                    <div class="h5 mb-0 fw-bold"><?= $jml_penerbangan; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-plane-departure fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4 text-white" style="background-color:#000 !important;border-radius: 20px;">
                        <?php
                        $hitung_transaksi    = mysqli_query($koneksi, "SELECT * FROM transaksi");
                        $jml_transaksi       = mysqli_num_rows($hitung_transaksi);
                        ?>
                        <div class="card-body">
                            <div class="row nu-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-cs fw-bold text-uppercase mb-1">Transaksi</div>
                                    <div class="h5 mb-0 fw-bold"><?= $jml_transaksi; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-basket fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4 text-white" style="background-color:#FFC425 !important;border-radius: 20px;">
                        <?php
                        $hitung_pelanggan    = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        $jml_pelanggan       = mysqli_num_rows($hitung_pelanggan);
                        ?>
                        <div class="card-body">
                            <div class="row nu-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-cs fw-bold text-uppercase mb-1">Pelanggan</div>
                                    <div class="h5 mb-0 fw-bold"><?= $jml_pelanggan; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 shadow p-4">
                        <div class="card-header py-2">
                            <h4 class="h4" style="color: #2E4765;">Pendapatan per Bulan</h4>
                        </div>
                        <div class="card-body">
                            <div id="response"></div>
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow p-4">
                        <div class="card-header py-2">
                            <h4 class="h4" style="color: #2E4765;">Status Maskapai</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $online = mysqli_query($koneksi, "SELECT * FROM maskapai");
                            ?>
                            <ul class="nav flex-column overflow-auto">
                                <?php
                                foreach ($online as $data) {
                                ?>
                                    <li class="nav-item">
                                        <?php
                                        if ($data['status'] == "1") {
                                        ?>
                                            <a class="nav-link active text-dark" aria-current="page" href="#"><?= $data['kode_penerbangan'] . " - " . $data['nama_maskapai']; ?>
                                                <i class="fas fa-dot-circle text-success"></i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="nav-link disabled text-gray" aria-current="page" href="#"><?= $data['kode_penerbangan'] . " - " . $data['nama_maskapai']; ?>
                                                <i class="fas fa-dot-circle text-gray"></i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card shadow p-4">
                        <div class="card-header">
                            <h4 class="h4 p-2" style="color: #2E4765;">Status Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $online = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                            ?>
                            <ul class="nav flex-column overflow-auto">
                                <?php
                                foreach ($online as $data) {
                                ?>
                                    <li class="nav-item">
                                        <?php
                                        if ($data['status'] == "1") {
                                        ?>
                                            <a class="nav-link active text-dark" aria-current="page" href="#"><?= $data['nama_lengkap']; ?>
                                                <i class="fas fa-dot-circle text-success"></i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="nav-link disabled text-gray" aria-current="page" href="#"><?= $data['nama_lengkap']; ?>
                                                <i class="fas fa-dot-circle text-gray"></i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 shadow p-4">
                        <div class="card-header py-2">
                            <h4 class="h4" style="color: #2E4765;">Jumlah Penerbangan Tiap Maskapai</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="100" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php
    } else if ($_SESSION['level'] == "maskapai") {
?>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-auto">
                    <div class="card p-4 text-white" style="background-color:#2E4DD4 !important;border-radius: 20px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="fw-bold">Hello <?= $_SESSION['nama']; ?>!</h5>
                                <p class="fw-lighter">Selamat datang di halaman <?= $_SESSION['level']; ?> plane.com Semoga harimu menyenangkan</p>
                            </div>
                            <div class="col-md-4">
                                <img src="../assets/images/background/dashboard.png" alt="Dashboard" class="img-responsive col-md-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row mt-5">
        <div class="col-md-8">
            <h4 class="h5 fw-bold" style="color: #2E4765;">Jadwal</h4>
            <p>Berikut ini jadwal penerbangan tertentu</p>
            <div class="table-responsive">

            </div>
        </div>
    </div>
<?php
    }
?>