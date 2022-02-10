<?php
if ($_SESSION['level'] == "admin") {
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Transaksi</h1>
    </div>
    <div class="row">
        <div class="card bg-white p-4 shadow border-0 text-dark">
            <h4 class="h4 fw-bold" style="color: #2E4765;">Data Transaksi</h4>
            <p>Berikut dibawah ini merupakan semua transaksi yang ada di plane.com </p>
            <div class="table-responsive">
                <table class="table table-stripped text-dark" id="transaksiTable">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Pelanggan</th>
                            <th>Maskapai</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN jadwal ON jadwal.id = transaksi.id_jadwal JOIN maskapai ON maskapai.kode_penerbangan = jadwal.kode_penerbangan ");
                        foreach ($query as $data) {
                        ?>
                            <tr>
                                <td><?= $data['kode_pesanan']; ?></td>
                                <td>
                                    <p><?= $data['nama_lengkap']; ?>
                                        <br>
                                        <small><?= $data['email_transaksi']; ?></small>
                                    </p>
                                </td>
                                <td><?= $data['nama_maskapai']; ?></td>
                                <td>IDR <?= number_format($data['jumlah_total'], "0", ".", ".") ?></td>
                                <?php
                                if ($data['keterangan'] == "Bayar") {
                                ?>
                                    <td class="text-success">Sudah Bayar</td>
                                <?php
                                } else if ($data['keterangan'] == "Belum") {
                                ?>
                                    <td class="text-danger">Belum Bayar</td>
                                <?php
                                }
                                ?>
                                <td>
                                    <a href="index.php?menu=transaksi-detail&kode_pesanan=<?= $data['kode_pesanan'] ?>" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Pelanggan</th>
                            <th>Maskapai</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
<?php
} else {
    header("Location:index.php");
}
?>