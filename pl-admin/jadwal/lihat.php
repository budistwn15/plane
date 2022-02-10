<?php
$bandara    = "../json/bandara.json";
$file       = file_get_contents($bandara);
$data       = json_decode($file, true);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Jadwal</h1>
</div>
<div class="row">
    <div class="card bg-white p-4 shadow border-0 text-dark">
        <div class="d-flex justify-content-between">
            <h4 class="h4 fw-bold" style="color: #2E4765;">Jadwal Penerbangan</h4>
            <?php
            if ($_SESSION['level'] == 'maskapai') {
            ?>
                <div class="btn-group">
                    <a href="<?= SITEURLMENU ?>jadwal-tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i></a>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        if ($_SESSION['level'] == 'admin') {
        ?>
            <p>Berikut dibawah ini merupakan semua jadwal penerbangan yang ada di plane.com</p>
        <?php
        } else {
        ?>
            <p>Berikut dibawah ini merupakan semua jadwal penerbangan maskapai <a href="#"><?= $_SESSION['nama'] ?></a></p>
        <?php
        }
        ?>
        <div class="table-responsive">
            <table class="table text-dark" id="jadwalTable">
                <?php
                if ($_SESSION['level'] == "admin") {
                ?>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Dari</th>
                            <th>Keberangkatan</th>
                            <th>Ke</th>
                            <th>Kedatangan</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin_jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal INNER JOIN maskapai ON maskapai.kode_penerbangan=jadwal.kode_penerbangan");
                        foreach ($admin_jadwal as $admin) {
                        ?>
                            <tr>
                                <td><?= $admin['nama_maskapai']; ?></td>
                                <td>
                                    <?php
                                    foreach ($data as $dari) {
                                        if ($dari['kode'] == $admin['dari'])
                                            echo $dari['kode'] . " - " . $dari['nama'];
                                    }
                                    ?>
                                </td>
                                <td><?= $admin['jam_keberangkatan']; ?></td>
                                <td>
                                    <?php
                                    foreach ($data as $ke) {
                                        if ($ke['kode'] == $admin['ke'])
                                            echo $ke['kode'] . " - " . $ke['nama'];
                                    }
                                    ?>
                                </td>
                                <td><?= $admin['kedatangan']; ?></td>
                                <td><?= $admin['total_harga']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Dari</th>
                            <th>Keberangkatan</th>
                            <th>Ke</th>
                            <th>Kedatangan</th>
                            <th>Harga</th>
                        </tr>
                    </tfoot>
                <?php
                } else if ($_SESSION['level'] == "maskapai" && $_SESSION['kode']) {
                ?>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Registrasi</th>
                            <th>Dari</th>
                            <th>Keberangkatan</th>
                            <th>Ke</th>
                            <th>Kedatangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $kode = $_SESSION['kode'];
                        $maskapai_jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_penerbangan='$kode' ORDER BY kode_penerbangan ASC");
                        foreach ($maskapai_jadwal as $maskapai) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $maskapai['kode_registrasi']; ?></td>
                                <td>
                                    <?php
                                    foreach ($data as $dari) {
                                        if ($dari['kode'] == $maskapai['dari'])
                                            echo $dari['kode'] . " - " . $dari['nama'];
                                    }
                                    ?>
                                </td>
                                <td><?= $maskapai['keberangkatan']; ?></td>
                                <td><?php
                                    foreach ($data as $ke) {
                                        if ($ke['kode'] == $maskapai['ke'])
                                            echo $ke['kode'] . " - " . $ke['nama'];
                                    }
                                    ?></td>
                                <td><?= $maskapai['kedatangan']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $maskapai['id'] ?>" class="btn btn-primary">Detail</a>
                                        <a href="#" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-primary">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal detail -->

                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>

                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>