<?php
if (isset($_SESSION['level']) == "pelanggan" && isset($_SESSION['email'])) {
    $id_pelanggan = $_SESSION['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN jadwal ON transaksi.id_jadwal = jadwal.id JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan WHERE id_pelanggan='$id_pelanggan'");
    $jumlah = mysqli_num_rows($query);
    // bandara
    $bandara = "json/bandara.json";
    $file_bandara = file_get_contents($bandara);
    $data_bandara = json_decode($file_bandara, true);
?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card p-4 bg-white border-0 shadow">
                    <div class="row text-center">
                        <img src="assets/images/background/profile.png" width="100" alt="">
                        <h3 class="fw-bold">Halo</h3>
                        <h5><?= $_SESSION['nama_lengkap']; ?></h5>

                    </div>
                    <div class="list-group mt-3">
                        <a href="index.php?menu=profile" class="list-group-item list-group-item-action">Akun Saya</a>
                        <a href="index.php?menu=pesanan" class="list-group-item list-group-item-action">Pesanan</a>
                        <a href="index.php?menu=ganti-kata-sandi" class="list-group-item list-group-item-action">Ganti Kata Sandi</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-4 bg-white border-0 shadow mb-4">
                    <h3>Pesanan Saya</h3>
                    <p>Disini kamu bisa melihat semua pesanan kamu.</p>
                    <span class="border-bottom"></span>
                </div>
                <?php
                if ($jumlah > 0) {
                    foreach ($query as $data) {
                ?>
                        <div class="card p-4 bg-white border-0 shadow mb-4">
                            <div class="card-header bg-white">
                                <div class="d-flex flex-row mb-2">
                                    <?php
                                    if ($data['logo'] != NULL) {
                                        echo "<img class='img-thumbnail' src='assets/images/logo/maskapai/" . $data['logo'] . "'width='50'>";
                                    } else {
                                        echo "Logo tidak tersedia";
                                    }
                                    ?>
                                    <div class="fw-bold ms-2 lh-lg"><?= $data['nama_maskapai']; ?></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Booking ID : <?= $data['kode_pesanan']; ?></p>
                                <p class="fw-bold">
                                    <?php
                                    foreach ($data_bandara as $dari_bandara) {
                                        if ($dari_bandara['kode'] == $data['dari']) {
                                            echo $dari_bandara['kota'];
                                    ?>
                                    <?php
                                        }
                                    }
                                    ?> -
                                    <?php
                                    foreach ($data_bandara as $ke_bandara) {
                                        if ($ke_bandara['kode'] == $data['ke']) {
                                            echo $ke_bandara['kota'];
                                    ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                </p>
                                <p><?= $data['perjalanan'] . " - 1 " . $data['kategori'] . " | " . $data['keberangkatan'] . " * " . $data['jam_keberangkatan']  . " | " . $data['kedatangan'] . " * " . $data['jam_kedatangan']; ?></p>
                                <div class="d-flex justify-content-between">
                                    <?php
                                    if ($data['keterangan'] == "Belum") {
                                    ?>
                                        <a href="index.php?menu=pembayaran&kode_pesanan=<?= $data['kode_pesanan'] ?>" class="btn btn-danger text-white text-decoration-none fw-bold">Belum Bayar</a>
                                    <?php
                                    } else if ($data['keterangan'] == "Bayar") {
                                    ?>
                                        <div class="btn-group">
                                            <a class="btn btn-success fw-bold">Sudah Bayar</a>
                                            <a href="index.php?menu=e-ticket&kode_pesanan=<?= $data['kode_pesanan'] ?>" class="btn btn-outline-success fw-bold">Cetak Tiket</a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="btn-group">
                                            <a class="btn btn-warning fw-bold text-white">Menunggu Konfirmasi</a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <a href="" class="fw-bold text-decoration-none">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-danger">
                        Kamu tidak memiliki pesanan, silahkan untuk memesan tiket terlebih dahulu
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
<?php
} else {
    header("Location:index.php");
}
?>