<?php
if (isset($_SESSION['level']) == "pelanggan") {
    // data negara
    $negara_json    = "json/negara.json";
    $file_n         = file_get_contents($negara_json);
    $data_negara    = json_decode($file_n, true);
    // data bandara
    $bandara        = "json/bandara.json";
    $file           = file_get_contents($bandara);
    $data_bandara   = json_decode($file, true);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM jadwal JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan WHERE id='$id'");
        $data = mysqli_fetch_array($query);
        $awal = date_create($data['jam_keberangkatan']);
        $akhir = date_create($data['jam_kedatangan']);
        $diff = date_diff($awal, $akhir);
    }
?>
    <div class="alert alert-primary" style="background-color: #005EB7 !important;">
        <h5 class="alert-heading text-white text-center">Mohon selesaikan pesanan anda </h5>
    </div>

    <div class="container">
        <form action="index.php?menu=detail-form" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
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
                                    <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Nama Depan" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" placeholder="Nama Belakang" required>
                                </div>
                                <div class="col">
                                    <select name="kategori" id="kategori" class="form-select" required>
                                        <option value="Dewasa">Dewasa</option>
                                        <option value="Anak-Anak">Anak-Anak</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
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
                                <label for="negara" class="form-label">Kode Negara</label>
                                <select name="negara" class="form-select" id="negara" required>
                                    <?php
                                    foreach ($data_negara as $country) {
                                    ?>
                                        <option value="<?= $country['code'] ?>"><?= $country['code'] . " - " . $country['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="" class="form-label">No Handphone</label>
                                <input type="tel" name="no_handphone" id="no_handphone" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email_transaksi" id="email_transaksi" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4 bg-white border-0 shadow-sm my-4">
                        <h3 class="text-primary">Pernyataan</h3>
                        <span class="border-bottom"></span>
                        <div class="row mt-4">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="pernyataan" class="form-check-input" id="pernyataan" value="1" required>
                                <label for="pernyataan" class="form-check-label">Dengan mengklik tombol proses di bawah untuk melanjutkan pemesanan, saya mengonfirmasi
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
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Biaya Tambahan</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Layanan Lain</div>
                                </div>
                            </li>
                        </ol>
                        <span class="border-bottom mt-4"></span>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="fw-bold">Jumlah Total</div>
                            <dov class="fw-bold">IDR 0</dov>
                        </div>

                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" name="proses" value="Proses" class="btn btn-primary" id="tombol">
                    </div>
                </div>
            </div>
    </div>
    </form>
<?php
} else {
    header("Location:login.php");
}
?>