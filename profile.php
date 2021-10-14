<?php
if (isset($_SESSION['level']) == "pelanggan" && isset($_SESSION['email'])) {
    $id = $_SESSION['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $nama = $data['nama_lengkap'];
    $pisah  = explode(" ", $nama);
    if (isset($_GET["pesan"])) {
        $pesan = $_GET["pesan"];
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
                }
                ?>
                <div class="card p-4 bg-white border-0 shadow">
                    <h3>Detail Akun</h3>
                    <p>Disini kamu bisa mengatur detail akunmu.</p>
                    <div class="row">
                        <div class="col-md-6 bg-light p-2">
                            <h6 class="text-muted">Email</h6>
                            <p><?= $_SESSION['email']; ?></p>
                            <h6 class="text-muted">Nomor Handphone</h6>
                            <p><?= $_SESSION['no_hp']; ?></p>
                        </div>
                        <div class="col-md-6 p-2">
                            <form action="index.php?menu=profile-edit" method="POST" class="was-validate">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Masukkan Nama" value="<?= $pisah[0] ?>" required>
                                    <label for="">Nama Depan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" placeholder="Masukkan Nama" value="<?= $pisah[1] ?>" required>
                                    <label for="">Nama Belakang</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="<?= $data['tanggal_lahir'] ?>" required>
                                    <label for="">Tanggal Lahir</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="negara" id="negara" class="form-control" placeholder="Masukkan Negara" value="<?= $data['negara'] ?>" readonly>
                                    <label for="negara">Negara</label>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
                                </div>
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