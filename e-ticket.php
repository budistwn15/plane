<?php
if (isset($_GET['kode_pesanan'])) {
    $kode_pesanan = $_GET['kode_pesanan'];
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
        <h5 class="alert-heading text-white text-center">Pemesanan Tiket Anda Telah Dikonfirmasi !</h5>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card bg-white p-4 shadow-sm border-0">
                    <h6 class="fw-bold text-primary">Boarding Pass</h6>
                    <h2 class="fw-bold">
                        <?php
                        foreach ($data_bandara as $dari_bandara) {
                            if ($dari_bandara['kode'] == $data['dari']) {
                                echo $dari_bandara['kota'];
                            }
                        }
                        echo " - ";
                        foreach ($data_bandara as $ke_bandara) {
                            if ($ke_bandara['kode'] == $data['ke']) {
                                echo $ke_bandara['kota'];
                            }
                        }
                        ?>
                    </h2>
                    <p>Booking ID <span class="text-primary"><?= $kode_pesanan; ?></span></p>
                    <span class="border-bottom my-4"></span>
                    <div class="row">
                        <table class="table table-responsive">
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
                                <td class="align-middle">
                                    <p><strong><?= $data['nama_maskapai']; ?></strong>
                                        <br>
                                        <small class="text-muted"><?= $data['kode_penerbangan']; ?></small>
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <p>
                                        <strong><?= $data['jam_keberangkatan'] ?></strong>
                                        <br>
                                        <small class="text-muted">
                                            <?php
                                            foreach ($data_bandara as $dari_bandara) {
                                                if ($dari_bandara['kode'] == $data['dari']) {
                                                    echo $dari_bandara['nama'];
                                                }
                                            }
                                            ?>
                                        </small>
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <img src="assets/images/icon/dotplane.png" alt="">
                                </td>
                                <td class="align-middle">
                                    <p>
                                        <strong><?= $data['jam_kedatangan']; ?></strong>
                                        <br>
                                        <small class="text-muted">
                                            <?php
                                            foreach ($data_bandara as $ke_bandara) {
                                                if ($ke_bandara['kode'] == $data['ke']) {
                                                    echo $ke_bandara['nama'];
                                                }
                                            }
                                            ?>
                                        </small>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h6 class="fw-bold text-primary mt-4">Penumpang</h6>
                    <h6><?= $data['nama_lengkap']; ?> <small class="text-muted ms-4"><?= $data['kategori']; ?></small></h6>
                    <span class="border-bottom my-4"></span>
                    <h6 class="fw-bold text-primary">Detail Kontak</h6>
                    <h6><?= $data['email_transaksi']; ?></h6>
                    <h6><?= $data['no_handphone']; ?></h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white p-4 shadow-sm border-0">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold text-primary">Kontak</h6>

                    </div>
                    <div class="d-flex justify-content-start">
                        <?php
                        if ($data['logo'] != NULL) {
                            echo "<img src='assets/images/logo/maskapai/" . $data['logo'] . "'width='80'>";
                        } else {
                            echo "Logo tidak tersedia";
                        }
                        ?>
                        <p class="ms-4 mt-4"><?= $data['nama_maskapai']; ?> <br> <strong><?= $data['nomor_handphone']; ?></strong></p>

                    </div>
                </div>
                <div class="card bg-white p-4 shadow-sm border-0 mt-4">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold text-primary">Total Pembayaran</h6>
                        <h6 class="fw-bold">IDR 1.381.200</h6>
                    </div>
                </div>
                <div class="card bg-white p-4 shadow-sm border-0 mt-4">
                    <h6 class="fw-bold text-primary">QR Code</h6>
                    <?php
                    $url_plane = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    require_once("assets/plugins/phpqrcode/qrlib.php");
                    QRcode::png("$url_plane", "assets/images/qrcode/" . $data['nama_lengkap'] . $data['kode_pesanan'] . ".png", "H", 12, 2);

                    ?>
                    <img src="assets/images/qrcode/<?= $data['nama_lengkap'] . $data['kode_pesanan'] ?>.png" alt="">
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary btn-lg mt-4">Print</a>
    </div>
<?php
} else {
    header("Location:index.php");
}
