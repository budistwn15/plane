<?php
if ($_SESSION['level'] == "admin") {
    //ambil pesan jika ada
    if (isset($_GET["pesan"])) {
        $pesan = $_GET["pesan"];
    }
?>
    <!-- breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Maskapai</h1>
    </div>
    <div class="row">
        <div class="card bg-white p-4 shadow border-0">
            <?php
            if (isset($pesan)) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading text-dark fw-bold">Sukses!</h4>
                    <p><?= $pesan; ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>
            <div class="d-flex justify-content-between">
                <h5 class="h5 fw-bold" style="color: #4E4E4E !important;">Data Maskapai</h5>
                <a href="<?= SITEURLMENU ?>maskapai-tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i></a>
            </div>
            <p class="text-dark">Di bawah ini merupakan data semua maskapai yang ada di plane.com</p>
            <div class="table-responsive">
                <table class="table table-hover text-dark" id="maskapaiTable">
                    <thead>
                        <tr>
                            <th>Kode Penerbangan</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = allData($koneksi, "maskapai");
                        foreach ($query as $data) {
                        ?>
                            <tr>
                                <td><?= $data['kode_penerbangan']; ?></td>
                                <td><?= $data['nama_maskapai']; ?></td>
                                <td>
                                    <?php
                                    if ($data['logo'] != NULL) {
                                        echo "<img class='img-thumbnail' src='../assets/images/logo/maskapai/" . $data['logo'] . "'width='50'>";
                                    } else {
                                        echo "Logo tidak tersedia";
                                    }
                                    ?>
                                </td>
                                <td><?= $data['email']; ?></td>
                                <td><?= $data['nomor_handphone']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= SITEURLMENU . "maskapai-edit&kode_penerbangan=" . $data['kode_penerbangan']; ?>" class="btn btn-warning" name="ubah">Edit</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#hapusMaskapai" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Kode Penerbangan</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
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