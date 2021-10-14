<?php
if ($_SESSION['level'] == "pelanggan") {
    if ($_GET['tf']) {
        $tf = $_GET['tf'];
        $kode_pesanan   = $_GET['kode_pesanan'];
        $query          = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN jadwal ON transaksi.id_jadwal = jadwal.id JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan WHERE kode_pesanan='$kode_pesanan'");
        $data           = mysqli_fetch_array($query);
        $awal = date_create($data['jam_keberangkatan']);
        $akhir = date_create($data['jam_kedatangan']);
        $diff = date_diff($awal, $akhir);

        // data bandara
        $bandara        = "json/bandara.json";
        $file           = file_get_contents($bandara);
        $data_bandara   = json_decode($file, true);
?>
        <div class="alert alert-primary" style="background-color: #005EB7 !important;">
            <h5 class="alert-heading text-white text-center">Pembayaran </h5>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card p-4 bg-white border-0 shadow-sm my-4">
                        <h3 class="text-primary"><?= $data['dari'] . " - " . $data['ke']; ?></h3>
                        <p><?= $data['perjalanan'] . " | " . $diff->h . " jam " . $diff->i . " menit | "; ?>Bisnis</p>
                        <span class="border-bottom"></span>
                        <div class="row">
                            <table class="table table-responsive my-4 table-borderless">
                                <tr>
                                    <td class="align-middle">
                                        <?php
                                        if ($data['logo'] != NULL) {
                                            echo "<img src='assets/images/logo/maskapai/" . $data['logo'] . "'width='50'>";
                                        } else {
                                            echo "Logo tidak tersedia";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <strong><?= $data['nama_maskapai']; ?></strong>
                                        <br>
                                        <small class="text-muted"><?= $data['kode_registrasi']; ?></small>
                                    </td>
                                    <td class="text-center">
                                        <strong><?= $data['jam_keberangkatan']; ?></strong><br>
                                        <?php
                                        foreach ($data_bandara as $dari_bandara) {
                                            if ($dari_bandara['kode'] == $data['dari']) {
                                        ?>
                                                <small class="text-muted"><?= $dari_bandara['kota']; ?></small>
                                                <p><?= $dari_bandara['nama']; ?></p>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle"><?= $data['keberangkatan']; ?></td>
                                    <td class="align-middle text-center">
                                        <span class="text-muted"><?= $diff->h . " jam " . $diff->i . " menit"; ?></span>
                                        <br>
                                        <span class="text-primary"><?= $data['perjalanan']; ?></span>
                                    </td>
                                    <td class="align-middle"><?= $data['kedatangan']; ?></td>
                                    <td class="text-center">
                                        <strong><?= $data['jam_kedatangan']; ?></strong><br>
                                        <?php
                                        foreach ($data_bandara as $ke_bandara) {
                                            if ($ke_bandara['kode'] == $data['ke']) {
                                        ?>
                                                <small class="text-muted"><?= $ke_bandara['kota']; ?></small>
                                                <p><?= $ke_bandara['nama']; ?></p>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                    if ($_GET['tf'] == "mandiri") {
                    ?>
                        <h3 class="text-primary mt-5">Bank Mandiri</h3>
                        <div class="card p-4 bg-white shadow-sm border-0 my-4">
                            <img src="assets/images/pembayaran/bank mandiri baru.jpg" alt="" class="img-responsive" width="150">
                            <div class="fw-bold my-3">Informasi Penting</div>
                            <ol>
                                <li>Pastikan transfer ke nomor rekening sesuai dengan instruksi pembayaran</li>
                                <li>Pastikan kembali nominal pembayaran sesuai dengan pemesanan yang anda lakukan</li>
                            </ol>
                            <span class="border-bottom my-3"></span>
                            <p>Dengan menekan tombol lanjutkan, anda telah menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> Plane.com</p>
                        </div>
                    <?php
                    } else if ($_GET['tf'] == "bni") {
                    ?>
                        <h3 class="text-primary mt-5">Bank BNI</h3>
                        <div class="card p-4 bg-white shadow-sm border-0 my-4">
                            <img src="assets/images/pembayaran/bni.png" alt="" class="img-responsive" width="150">
                            <div class="fw-bold my-3">Informasi Penting</div>
                            <ol>
                                <li>Pastikan transfer ke nomor rekening sesuai dengan instruksi pembayaran</li>
                                <li>Pastikan kembali nominal pembayaran sesuai dengan pemesanan yang anda lakukan</li>
                            </ol>
                            <span class="border-bottom my-3"></span>
                            <p>Dengan menekan tombol lanjutkan, anda telah menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> Plane.com</p>
                        </div>
                    <?php
                    } else if ($_GET['tf'] == "bca") {
                    ?>
                        <h3 class="text-primary mt-5">Bank BCA</h3>
                        <div class="card p-4 bg-white shadow-sm border-0 my-4">
                            <img src="assets/images/pembayaran/bca klik.png" alt="" class="img-responsive" width="150">
                            <div class="fw-bold my-3">Informasi Penting</div>
                            <ol>
                                <li>Pastikan transfer ke nomor rekening sesuai dengan instruksi pembayaran</li>
                                <li>Pastikan kembali nominal pembayaran sesuai dengan pemesanan yang anda lakukan</li>
                            </ol>
                            <span class="border-bottom my-3"></span>
                            <p>Dengan menekan tombol lanjutkan, anda telah menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> Plane.com</p>
                        </div>
                    <?php
                    } else if ($_GET['tf'] == "bri") {
                    ?>
                        <h3 class="text-primary mt-5">Bank BRI</h3>
                        <div class="card p-4 bg-white shadow-sm border-0 my-4">
                            <img src="assets/images/pembayaran/briva.png" alt="" class="img-responsive" width="150">
                            <div class="fw-bold my-3">Informasi Penting</div>
                            <ol>
                                <li>Pastikan transfer ke nomor rekening sesuai dengan instruksi pembayaran</li>
                                <li>Pastikan kembali nominal pembayaran sesuai dengan pemesanan yang anda lakukan</li>
                            </ol>
                            <span class="border-bottom my-3"></span>
                            <p>Dengan menekan tombol lanjutkan, anda telah menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> Plane.com</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm border-0 bg-white my-4">
                        <div id="penumpang">
                            <h3>Penumpang</h3>
                            <div class="d-flex justify-content-between">
                                <p><?= $data['nama_lengkap']; ?></p>
                                <small><?= $data['kategori']; ?></small>
                            </div>
                        </div>
                        <span class="border-bottom my-3"></span>
                        <div id="detailKontak">
                            <h3>Detail Kontak</h3>
                            <p><?= $data['email_transaksi']; ?></p>
                            <p><?= $data['no_handphone']; ?></p>
                        </div>
                        <span class="border-bottom my-3"></span>
                        <div id="detailHarga">
                            <h3>Detail Harga</h3>
                            <div class="d-flex justify-content-between">
                                <div class="fw-bold">Total Pembayaran</div>
                                <div class="fw-bold text-primary">IDR <?= number_format($data['jumlah_total'], 0, ".", ".") ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <form action="index.php?menu=pembayaran-kode" method="POST">
                            <input type="hidden" name="kode_pesanan" id="kode_pesanan" value="<?= $kode_pesanan ?>">
                            <input type="hidden" name="tf" id="tf" value="<?= $tf ?>">
                            <input type="submit" class="btn btn-warning btn-lg text-light" value="Lanjutkan" name="lanjut">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        header("Location:index.php");
    }
} else {
    header("Location:index.php");
}
