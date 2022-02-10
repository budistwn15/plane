<?php
if ($_SESSION['level'] == "admin") {
    $id = $_SESSION['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);
    //ambil pesan jika ada
    if (isset($_GET["pesan"])) {
        $pesan = $_GET["pesan"];
    } else if (isset($_GET["pesan_error"])) {
        $pesan_error = $_GET["pesan_error"];
    }
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Profile</h1>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card bg-white p-4 shadow-sm mt-4 border-0 text-dark">
                <?php
                if (isset($pesan)) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading text-dark fw-bold">Sukses!</h4>
                        <p><?= $pesan; ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else if (isset($pesan_error)) {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading text-dark fw-bold">Gagal!</h4>
                        <p><?= $pesan_error; ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <img src="../assets/images/profile.png" alt="" width="200">
                    </div>
                    <div class="col-md-8">
                        <h3 class="mt-5 text-dark"><?= $data['nama_lengkap']; ?></h3>
                        <h6 class="fw-bold my-2">Admin</h6>
                        <a href="index.php?menu=profile-edit&id=<?= $id ?>" class="text-decoration-none text-dark"><i class="bi bi-pencil-square"></i> Edit</a>
                    </div>
                </div>
                <div class="mb-3 row text-dark ms-4">
                    <label for="nama" class="col-sm-2 col-form-label text-dark fw-bold">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="nama" value="<?= $data['nama_lengkap'] ?>">
                    </div>
                </div>
                <div class="mb-3 row text-dark ms-4">
                    <label for="email" class="col-sm-2 col-form-label text-dark fw-bold">Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="email" value="<?= $data['email'] ?>">
                    </div>
                </div>
                <div class="mb-3 row text-dark ms-4">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label text-dark fw-bold">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <img src="../assets/images/background/bg-profile.png" alt="" width="500" class="img-responsive">
        </div>
    </div>
<?php
} else {
    header("Location:index.php");
}
?>