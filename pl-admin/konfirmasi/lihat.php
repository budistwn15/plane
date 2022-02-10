<?php
if ($_SESSION['level'] == "admin") {
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Konfirmasi</h1>
    </div>
    <div class="row">
        <div class="card-bg-white p-4 shadow-sm text-dark border-0">
            <h4 class="fw-bold">Konfirmasi Pembayaran</h4>
            <p>Silahkan untuk melakukan cek pembayaran yang dilakukan oleh pelanggan!</p>

            <div class="table-responsve mt-4">
                <table class="table text-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Booking ID</th>
                            <th>Total Tagihan</th>
                            <th>Bank Tujuan</th>
                            <th>Bank Pengirim</th>
                            <th>Nama Rekening</th>
                            <th>No Rekening</th>
                            <th>Bukti Transfer</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN transaksi ON pembayaran.kode_pesanan = transaksi.kode_pesanan ORDER BY created_at ASC");
                        foreach ($query as $data) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-primary">#<?= $data['kode_pesanan']; ?></td>
                                <td>IDR <?= number_format($data['jumlah_total'], 0, ".", ".") ?></td>
                                <td><?= $data['bank_tujuan']; ?></td>
                                <td><?= $data['bank_pelanggan']; ?></td>
                                <td><?= $data['nama_rekening']; ?></td>
                                <td><?= $data['no_rekening']; ?></td>
                                <td>
                                    <?php
                                    if ($data['bukti_transfer'] != NULL) {
                                        echo "<a target='_blank' href='../assets/images/pembayaran/buktitf/" . $data['bukti_transfer'] . "'><img class='img-thumbnail' src='../assets/images/pembayaran/buktitf/" . $data['bukti_transfer'] . "'width='50'></a>";
                                    } else {
                                        echo "Logo tidak tersedia";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data['keterangan'] == "Menunggu") {
                                        echo "Menunggu Konfirmasi";
                                    } else if ($data['keterangan'] == "Bayar") {
                                        echo "Sudah dikonfirmasi";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data['keterangan'] == "Menunggu") {
                                    ?>
                                        <a href="index.php?menu=konfirmasi-pesanan&id=<?= $data['id'] ?>&pelanggan=<?= $data['id_pelanggan'] ?>" class="btn btn-primary">Konfirmasi</a>
                                    <?php
                                    } else if ($data['keterangan'] == "Bayar") {
                                    ?>
                                        <a class="btn btn-success">Selesai</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>

                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
} else {
    header("Location:index.php");
}
?>