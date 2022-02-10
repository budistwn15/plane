<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id='$id'");
    $data  = mysqli_fetch_array($query);

    if (isset($_POST['edit'])) {
        $nama = isValidate($_POST['nama_lengkap']);
        $email = isValidate($_POST['email']);
        $kata_sandi_lama = isValidate($_POST['kata_sandi_lama']);
        $kata_sandi_baru = isValidate($_POST['kata_sandi_baru']);
        $tanggal_lahir = isValidate($_POST['tanggal_lahir']);

        $isNama     = "";
        $isEmail    = "";
        $isKataSandiLama = "";
        $isKataSandiBaru = "";
        $isTanggalLahir = "";

        $isNama = isEmpty($nama, $isNama);
        $isEmail = isEmpty($email, $isEmail);
        $isKataSandiLama = isEmpty($kata_sandi_lama, $isKataSandiLama);
        $isKataSandiBaru = isEmpty($kata_sandi_baru, $isKataSandiBaru);

        // filter semua data
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $email = mysqli_real_escape_string($koneksi, $email);
        $kata_sandi_lama = mysqli_real_escape_string($koneksi, $kata_sandi_lama);
        $kata_sandi_baru = mysqli_real_escape_string($koneksi, $kata_sandi_baru);
        $tanggal_lahir = mysqli_real_escape_string($koneksi, $tanggal_lahir);

        $kata_sandi_lama = sha1($kata_sandi_lama);
        $kata_sandi_baru = sha1($kata_sandi_baru);

        if ($kata_sandi_lama == $data['kata_sandi']) {
            $query = mysqli_query($koneksi, "UPDATE admin SET nama_lengkap='$nama',email='$email',kata_sandi='$kata_sandi_baru',tanggal_lahir='$tanggal_lahir' WHERE id='$id'");
            if ($query) {
                $pesan = "Berhasil merubah profile";
                $pesan = urlencode($pesan);
                header("Location:index.php?menu=profile&pesan={$pesan}");
            } else {
                $pesan_error = "Gagal merubah profile";
                $pesan_error = urlencode($pesan_error);
                header("Location:index.php?menu=profile&pesan_error={$pesan_error}");
            }
        } else {
            $pesan_error = "Gagal merubah profile password tidak sama";
            $pesan_error = urlencode($pesan_error);
            header("Location:index.php?menu=profile&pesan_error={$pesan_error}");
        }
    } else {
        $pesan_error = "";
        $pesan = "";
        $nama = "";
        $email = "";
        $kata_sandi_lama = "";
        $kata_sandi_baru = "";
        $tanggal_lahir = "";
        $isNama = "";
        $isEmail = "";
        $isKataSandiLama = "";
        $isKataSandiBaru = "";
        $isTanggalLahir = "";
    }
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Profile</h1>
    </div>
    <div class="row">
        <div class="card bg-white p-4 shadow-sm border-0 text-dark">
            <h4 class="text-dark fw-bold">Edit Profile</h4>
            <p class="text-dark">Silahkan untuk mengubah profile</p>
            <form action="#" method="POST" class="was-validate mt-4">
                <div class="mb-3 row">
                    <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo $isNama; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>">
                        <div class="invalid-feedback">
                            Nama harus diisi
                        </div>
                        <div class="valid-feedback">
                            Nama sudah diisi
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control <?php echo $isEmail; ?>" id="email" name="email" value="<?= $data['email'] ?>">
                        <div class="invalid-feedback">
                            Email harus diisi
                        </div>
                        <div class="valid-feedback">
                            Email sudah diisi
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kata_sandi_lama" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?php echo $isKataSandiLama; ?>" id="kata_sandi_lama" name="kata_sandi_lama">
                        <div class="invalid-feedback">
                            Password lama harus diisi
                        </div>
                        <div class="valid-feedback">
                            Password lama sudah diisi
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kata_sandi_baru" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?php echo $isKataSandiBaru; ?>" id="kata_sandi_baru" name="kata_sandi_baru">
                        <div class="invalid-feedback">
                            Password baru harus diisi
                        </div>
                        <div class="valid-feedback">
                            Password baru sudah diisi
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?php echo $isTanggalLahir; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">
                        <div class="invalid-feedback">
                            Tanggal lahir harus diisi
                        </div>
                        <div class="valid-feedback">
                            Tanggal lahir sudah diisi
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input type="submit" value="Edit Profile" name="edit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>