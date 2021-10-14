<?php
if (isset($_SESSION['level']) == "pelanggan" && isset($_SESSION['email'])) {
    $id = $_SESSION['id'];
    if (isset($_GET["pesan"])) {
        $pesan = $_GET["pesan"];
    } else if (isset($_GET["pesan_error"])) {
        $pesan_error = $_GET["pesan_error"];
    }
?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card p-4 bg-white border-0 shadow">

                    <div class="row text-center">
                        <img src="assets/images/background/profile.png" width="100" alt="">
                        <h3 class="fw-bold">Halo</h3>
                        <h5><?= $_SESSION['nama_lengkap']; ?></h5>

                    </div>
                    <div class="list-group mt-3">
                        <a href="index.php?menu=profile" class="list-group-item list-group-item-action">Akun Saya</a>
                        <a href="index.php?menu=pesanan" class="list-group-item list-group-item-action">Pesanan</a>
                        <a href="index.php?menu=ganti-kata-sandi" class="list-group-item list-group-item-action">Ganti Kata Sandi</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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
                <div class="card p-4 bg-white border-0 shadow">
                    <h3>Detail Akun</h3>
                    <p>Disini kamu bisa mengubah password kamu.</p>
                    <div class="row">
                        <form action="index.php?menu=ganti-kata-sandi-proses" method="POST" class="was-validate">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="form-floating mb-3">
                                <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Masukkan Password" required>
                                <label>Password Lama</label>
                            </div>
                            <div class=" form-floating mb-3">
                                <input type="password" name="password_baru" id="password_baru" class="form-control" placeholder="Masukkan Password" required>
                                <label>Password Baru</label>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php
} else {
    header("Location:index.php");
}
?>