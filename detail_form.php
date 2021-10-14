<?php
if (isset($_POST['proses'])) {
    if (isset($_SESSION['level']) == "pelanggan") {
        include "lib/kode_pesanan.php";
        // data negara
        $negara_json    = "json/negara.json";
        $file_n         = file_get_contents($negara_json);
        $data_negara    = json_decode($file_n, true);
        // data bandara
        $bandara        = "json/bandara.json";
        $file           = file_get_contents($bandara);
        $data_bandara   = json_decode($file, true);
        $id = isValidate($_POST['id']);
        $query = mysqli_query($koneksi, "SELECT * FROM jadwal JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan WHERE id='$id'");
        $data = mysqli_fetch_array($query);
        $awal = date_create($data['jam_keberangkatan']);
        $akhir = date_create($data['jam_kedatangan']);
        $diff = date_diff($awal, $akhir);

        // Detail Penumpang
        $nama_depan = isValidate($_POST['nama_depan']);
        $nama_belakang = isValidate($_POST['nama_belakang']);
        $jenis_kelamin = isValidate($_POST['jenis_kelamin']);

        // kontak Informasi
        $negara = isValidate($_POST['negara']);
        $no_handphone = isValidate($_POST['no_handphone']);
        $email_transaksi  = isValidate($_POST['email_transaksi']);

        // pernytaan
        $pernyataan = isValidate($_POST['pernyataan']);

        // Ringkasan Pembayaran
        $kategori = isValidate($_POST['kategori']);
        $harga_dewasa = $data['total_harga'];
        $harga_anak = $data['total_harga'] / 2;
        $biaya_tambahan = 0.10 * $data['total_harga'];
        define("AMAL", 10000);

        $jumlah_total_dewasa = $harga_dewasa + $biaya_tambahan + AMAL;
        $jumlah_total_anak = $harga_anak + $biaya_tambahan + AMAL;
?>
        <div class="alert alert-primary" style="background-color: #005EB7 !important;">
            <h5 class="alert-heading text-white text-center">Mohon selesaikan pesanan anda </h5>
        </div>

        <div class="container">
            <form action="index.php?menu=detail-form-proses" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="kode_pesanan" value="<?= $kode_pesanan ?>">
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="card p-4 bg-white border-0 shadow-sm my-4">
                            <h3 class="text-primary"><?= $data['dari'] . " - " . $data['ke']; ?> </h3>
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
                        <div class="card p-4 bg-white border-0 shadow-sm my-4">

                            <h3 class="text-primary">Detail Penumpang</h3>
                            <span class="border-bottom"></span>
                            <div class="row mt-4">
                                <div class="row mt-2">
                                    <div class="col">
                                        <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Nama Depan" value="<?= $nama_depan ?>" readonly>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" placeholder="Nama Belakang" value="<?= $nama_belakang ?>" readonly>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="kategori" id="kategori" class="form-control" value="<?= $kategori ?>" readonly>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="<?= $jenis_kelamin ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card p-4 bg-white border-0 shadow-sm my-4">
                            <h3 class="text-primary">Kontak Informasi</h3>
                            <span class="border-bottom"></span>
                            <p class="text-muted">Informasi tiket dan penerbangan anda akan dikirim kesini</p>
                            <div class="row">
                                <div class="col">
                                    <label for="kode_negara" class="form-label">Kode Negara</label>
                                    <input type="text" name="kode_negara" id="kode_negara" class="form-control" value="<?= $negara ?>" readonly>
                                    </p>
                                </div>
                                <div class="col">
                                    <label for="no_handphone" class="form-label">No Handphone</label>
                                    <input type="tel" name="no_handphone" id="no_handphone" class="form-control" value="<?= $no_handphone ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email_transaksi" id="email_transaksi" class="form-control" value="<?= $email_transaksi ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card p-4 bg-white border-0 shadow-sm my-4">
                            <h3 class="text-primary">Pernyataan</h3>
                            <span class="border-bottom"></span>
                            <div class="row mt-4">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="pernyataan" class="form-check-input" id="pernyataan" value="<?= $pernyataan ?>" checked>
                                    <label for="" class="form-check-label">Dengan mengklik tombol proses di bawah untuk melanjutkan pemesanan, saya mengonfirmasi
                                        bahwa saya telah membaca dan saya menerima aturan tarif, kebijakan privasi, persetujuan pengguna
                                        dan persyaratan layanan plane.com</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4 bg-white border-0 shadow-sm my-4">
                            <h4 class="text-primary">Ringkasan Pembayaran</h4>
                            <span class="border-bottom my-3"></span>
                            <ol class="list-group">
                                <li class="list-group-item">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Tarif Dasar</div>
                                        <div class="d-flex justify-content-between" id="tarif">
                                            <?php
                                            if ($kategori == "Dewasa") {
                                            ?>
                                                <small><?= $kategori; ?></small>
                                                <small>IDR <?= number_format($harga_dewasa, "0", ".", ".") ?></small>
                                                <input type="hidden" name="tarif_dasar" value="<?= $harga_dewasa ?>">
                                            <?php
                                            } else if ($kategori == "Anak-Anak") {
                                            ?>
                                                <small><?= $kategori; ?></small>
                                                <small>IDR <?= number_format($harga_anak, "0", ".", ".") ?></small>
                                                <input type="hidden" name="tarif_dasar" value="<?= $harga_anak ?>">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Biaya Tambahan</div>
                                        <div class="d-flex justify-content-between">
                                            <small>Total Biaya Tambahan </small>
                                            <small>IDR <?= number_format($biaya_tambahan, "0", ".", ".") ?></small>
                                            <input type="hidden" name="biaya_tambahan" value="<?= $biaya_tambahan ?>">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Layanan Lain</div>
                                        <div class="d-flex justify-content-between">
                                            <small>Amal </small>
                                            <small>IDR <?= number_format(AMAL, "0", ".", ".") ?></small>
                                            <input type="hidden" name="amal" value="<?= AMAL ?>">
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            <span class="border-bottom mt-4"></span>
                            <div class="d-flex justify-content-between mt-4">
                                <div class="fw-bold">Jumlah Total</div>
                                <?php
                                if ($kategori == "Dewasa") {
                                ?>
                                    <div class="fw-bold">IDR <?= number_format($jumlah_total_dewasa, "0", ".", ".") ?></div>
                                    <input type="hidden" name="jumlah_total" value="<?= $jumlah_total_dewasa ?>">
                                <?php
                                } else if ($kategori == "Anak-Anak") {
                                ?>
                                    <div class="fw-bold">IDR <?= number_format($jumlah_total_anak, "0", ".", ".") ?></div>
                                    <input type="hidden" name="jumlah_total" value="<?= $jumlah_total_anak ?>">
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                        <div class="d-grid gap-2">
                            <a href="index.php?menu=detail&id=<?= $id ?>" class="btn btn-warning text-white">Kembali</a>
                            <input type="submit" name="proses" value="Proses" class="btn btn-primary" id="proses">
                            <!-- <a href="index.php?menu=pembayaran" class="btn btn-primary">Bayar</a> -->
                        </div>
                    </div>
                </div>
        </div>
        </form>
<?php
    } else {
        header("Location:login.php");
    }
}
?>