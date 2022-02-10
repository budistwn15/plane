<?php
if ($_SESSION['level'] == "admin") {
    if (isset($_GET['kode_pesanan'])) {
        $kode_pesanan = $_GET['kode_pesanan'];
        $query = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN jadwal ON jadwal.id = transaksi.id_jadwal JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan WHERE kode_pesanan='$kode_pesanan'");
        $data = mysqli_fetch_assoc($query);

        // data bandara
        $bandara        = "../json/bandara.json";
        $file           = file_get_contents($bandara);
        $data_bandara   = json_decode($file, true);

        // durasi
        $awal = date_create($data['jam_keberangkatan']);
        $akhir = date_create($data['jam_kedatangan']);
        $diff = date_diff($awal, $akhir);
?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Transaksi</h1>
        </div>

        <div class="card bg-white p-4 shadow-sm border-0 text-dark">
            <div class="d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <h6 class="fw-bold text-dark">Detail Transaksi <span class="text-primary"><?= $data['kode_pesanan']; ?></span></h6>
                    <p>Tanggal Transaksi : 15 November 2020</p>
                </div>
                <p>Keberangkatan : <?= $data['keberangkatan']; ?></p>
            </div>
            <span class="my-4" style="border-bottom:1px dotted #707070">
            </span>
            <div class="d-flex justify-content-between align-items-start mt-4">
                <div class="ms-2 me-auto">
                    <h6 class="fw-bold text-dark">Penumpang</h6>
                    <p><?= $data['nama_lengkap'] . " | " . $data['jenis_kelamin'] . " | " . $data['kategori']; ?></p>
                </div>
                <div class="ms-2 me-auto">
                    <h6 class="fw-bold text-dark">Detail Kontak</h6>
                    <p><?= $data['email_transaksi'] . " | " . $data['no_handphone']; ?></p>
                </div>
            </div>
            <span class="my-4" style="border-bottom:1px dotted #707070">
            </span>
            <div class="table-responsive my-4">
                <table class="table text-center text-dark">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Dari</th>
                            <th>Durasi</th>
                            <th>Ke</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="../assets/images/logo/maskapai/airasia.jpg" alt="" width="50">
                            </td>
                            <td><?= $data['nama_maskapai']; ?></td>
                            <td class="text-dark">
                                <?php
                                foreach ($data_bandara as $dari_bandara) {
                                    if ($dari_bandara['kode'] == $data['dari']) {
                                        echo $dari_bandara['kota'] . " (" . $dari_bandara['kode'] . ")";
                                ?>
                                        <p><?= $dari_bandara['nama']; ?></p>
                                <?php
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $diff->h . " jam " . $diff->i . " menit"; ?></td>
                            <td class="text-dark">
                                <?php
                                foreach ($data_bandara as $ke_bandara) {
                                    if ($ke_bandara['kode'] == $data['ke']) {
                                        echo $ke_bandara['kota'] . " (" . $dari_bandara['kode'] . ")";
                                ?>
                                        <p><?= $ke_bandara['nama']; ?></p>
                                <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <span class="my-4" style="border-bottom:1px dotted #707070">
            </span>
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold text-dark">Total Pembayaran
                    <span class="text-primary ms-4">IDR <?= number_format($data['jumlah_total'], "0", ".", ".") ?></span>
                </h6>
                <h6 class="fw-bold">Status
                    <?php
                    if ($data['keterangan'] == "Bayar") {
                    ?>
                        <a class="btn btn-success">Sudah Dibayar</a>
                    <?php
                    } else if ($data['keterangan'] == "Belum") {
                    ?>
                        <a class="btn btn-danger">Belum Bayar</a>
                    <?php
                    }
                    ?>
                </h6>
            </div>
        </div>

        <a href="index.php?menu=transaksi" class="btn btn-danger mt-4">Kembali</a>
<?php
    } else {
        header("Location:index.php");
    }
} else {
    header("Location:index.php");
}
?>