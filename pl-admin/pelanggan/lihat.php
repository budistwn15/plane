<?php
if ($_SESSION['level'] == "admin") {
    //ambil pesan jika ada
    if (isset($_GET["pesan"])) {
        $pesan = $_GET["pesan"];
    }
?>
    <!-- breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Pelanggan</h1>
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
                <h5 class="h5 fw-bold" style="color: #2E4765;">Data Pelanggan</h5>
            </div>
            <p>Di bawah ini merupakan data semua pelanggan yang ada di plane.com</p>
            <div class="table-responsive">
                <table class="table table-hover text-dark" id="pelangganTable">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor Handphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = orderData($koneksi, "pelanggan", "id", "ASC");
                        foreach ($query as $data) {
                        ?>
                            <tr>
                                <td><?= $data['nama_lengkap']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td><?= $data['tanggal_lahir']; ?></td>
                                <td><?= $data['nomor_handphone']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#hapusPelanggan" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor Handphone</th>
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