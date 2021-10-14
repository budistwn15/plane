<?php
if ($_SESSION['level'] == "pelanggan") {
    include "lib/function.php";
    if (isset($_POST['lanjut'])) {
        $tf = $_POST['tf'];
        $kode_pesanan   = $_POST['kode_pesanan'];
        $query          = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN jadwal ON transaksi.id_jadwal = jadwal.id JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan WHERE kode_pesanan='$kode_pesanan'");
        $data           = mysqli_fetch_array($query);
        $awal = date_create($data['jam_keberangkatan']);
        $akhir = date_create($data['jam_kedatangan']);
        $diff = date_diff($awal, $akhir);
        $email_transaksi = $data['email_transaksi'];

        // data bandara
        $bandara        = "json/bandara.json";
        $file           = file_get_contents($bandara);
        $data_bandara   = json_decode($file, true);
?>
        <div class="alert alert-primary" style="background-color: #005EB7 !important;">
            <h5 class="alert-heading text-white text-center">Segera untuk menyelesaikan pembayaran</h5>
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
                    <h3 class="text-primary mt-5">Bank Transfer</h3>
                    <div class="card p-4 bg-white shadow-sm border-0 my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="fw-bold my-2">Silahkan Transfer Ke</div>
                            </li>
                            <li class="list-group-item">
                                <span class="text-muted">Bank Transfer</span>
                                <div class="fw-bold"><?= $tf; ?></div>
                            </li>
                            <li class="list-group-item">
                                <span class="text-muted">Nomor Rekening Account</span>
                                <div class="fw-bold"><?= rekening($tf) ?></div>
                            </li>
                            <li class="list-group-item">
                                <span class="text-muted">Total Pembayaran</span>
                                <div class="fw-bold text-primary">IDR <?= number_format($data['jumlah_total'], '0', '.', '.') ?></div>
                            </li>
                        </ul>
                    </div>
                    <h3 class="text-primary mt-5">Cara Pembayaran</h3>
                    <div class="card p-4 bg-white shadow-sm border-0 my-4">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Transfer Melalui ATM
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Masukkan Kartu ATM</li>
                                            <li>Pilih Bahasa</li>
                                            <li>Masukkan Nomor PIN</li>
                                            <li>Pilih Menu Transfer</li>
                                            <li>Pilih Bank Tujuan Transfer</li>
                                            <li>Masukkan Jumlah Yang Ingin Ditransfer</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Transfer Melalui Mobile Banking
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <p><?= $email_transaksi; ?></p>
                            <p><?= $data['no_handphone']; ?></p>
                        </div>
                        <span class="border-bottom my-3"></span>
                        <div id="detailHarga">
                            <h3>Detail Harga</h3>
                            <div class="d-flex justify-content-between">
                                <div class="fw-bold">Total Pembayaran</div>
                                <div class="fw-bold text-primary">IDR <?= number_format($data['jumlah_total'], 0, ".", "."); ?></div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiPembayaran">
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="konfirmasiPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?menu=konfirmasi-pembayaran" method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" name="kode_pesanan" id="kode_pesanan" class="form-control" placeholder="Kode Pesanan" value="<?= $kode_pesanan ?>" readonly>
                                <label for="">Kode Pesanan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control" placeholder="Bank Tujuan" value="<?= $tf ?>" readonly>
                                <label for="">Bank Tujuan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="bank_pelanggan" id="bank_pelanggan" class="form-control" placeholder="Bank Pelanggan" required>
                                <label for="">Bank Anda</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Nama Rekening" required>
                                <label for="">Nama Rekening</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="no_rekening" id="no_rekening" class="form-control" placeholder="No Rekening" required>
                                <label for="">No Rekening</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" placeholder="Bukti Transfer" required>
                                <label for="">Bukti Transfer</label>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Konfirmasi" name="konfirmasi" class="btn btn-primary">
                    </div>
                    </form>
                </div>
            </div>
        </div>>
<?php
    }
} else {
    header("Location:index.php");
}
?>