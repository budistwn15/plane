<?php
if ($_SESSION['level'] == "admin") {
    if (isset($_GET['kode_penerbangan'])) {
        $kode_penerbangan = $_GET['kode_penerbangan'];
        $query = showDataPrimary($koneksi, "maskapai", "kode_penerbangan", $kode_penerbangan);
        $data = mysqli_fetch_assoc($query);
        if (isset($_POST['edit'])) {
            $kode_penerbangan   = isValidate($_POST['kode_penerbangan']);
            $nama               = isValidate($_POST['nama_maskapai']);
            $email              = isValidate($_POST['email']);
            $kata_sandi         = isValidate($_POST['kata_sandi']);
            $no_handphone       = isValidate($_POST['nomor_handphone']);

            $hash_kata_sandi    = sha1($kata_sandi);

            //konfigurasi logo
            $nama_file          = $_FILES['logo']['name'];
            $ukuran_file        = $_FILES['logo']['size'];
            $tipe_file          = $_FILES['logo']['type'];
            $tmp_file           = $_FILES['logo']['tmp_name'];

            // lokasi penyimpanan
            $lokasi = "../assets/images/logo/maskapai/" . $nama_file;

            $isKode         = "";
            $isNama         = "";
            $isEmail        = "";
            $isKataSandi    = "";
            $isNoHandphone  = "";
            $isLogo         = "";

            $isKode         = isEmpty($kode_penerbangan, $isKode);
            $isNama         = isEmpty($nama, $isNama);
            $isEmail        = isEmpty($email, $isEmail);
            $isKataSandi    = isEmpty($kata_sandi, $isKataSandi);
            $isNoHandphone  = isEmpty($no_handphone, $isNoHandphone);
            $isLogo         = isEmpty($nama_file, $isLogo);
            // $isLogo         = isEmpty($nama_file, $isLogo);


            // filter semua data
            $kode_penerbangan   = mysqli_real_escape_string($koneksi, $kode_penerbangan);
            $nama               = mysqli_real_escape_string($koneksi, $nama);
            $email              = mysqli_real_escape_string($koneksi, $email);
            $kata_sandi         = mysqli_real_escape_string($koneksi, $kata_sandi);
            $no_handphone       = mysqli_real_escape_string($koneksi, $no_handphone);

            if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
                if ($ukuran_file <= 1000000) {
                    if (move_uploaded_file($tmp_file, $lokasi)) {
                        $query = mysqli_query($koneksi, "UPDATE maskapai SET nama_maskapai='$nama',email='$email',kata_sandi='$hash_kata_sandi',nomor_handphone='$no_handphone',logo='$nama_file' WHERE kode_penerbangan='$kode_penerbangan'");
                        redirectURL($query, "maskapai");
                    } else {
                        echo "Gambar gagal di upload";
                    }
                } else {
                    echo "Ukuran gambar maksimal 1mb";
                }
            } else {
                $query = mysqli_query($koneksi, "UPDATE maskapai SET nama_maskapai='$nama',email='$email',kata_sandi='$hash_kata_sandi',nomor_handphone='$no_handphone' WHERE kode_penerbangan='$kode_penerbangan'");
                redirectURL($query, "maskapai");
            }
        } else {
            $kode_penerbangan   = "";
            $nama               = "";
            $email              = "";
            $kata_sandi         = "";
            $no_handphone       = "";
            $isKode             = "";
            $isNama             = "";
            $isEmail            = "";
            $isKataSandi        = "";
            $isNoHandphone      = "";
            $isLogo             = "";
        }
?>

        <!-- breadcrumb -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Maskapai</h1>
            <!-- profile -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="text-muted text-decoration-none">Logout</a>
        </div>
        <div class="row">
            <div class="card bg-white shadow p-4 border-0 text-dark">
                <h5 class="h5 text-dark fw-bold">Edit Maskapai</h5>
                <p>Silahkan untuk mengubah data maskapai</p>
                <form class="was-validate" action="#" method="POST" enctype="multipart/form-data" id="formMaskapai">
                    <div class="mb-3">
                        <label for="kode_penerbangan" class="form-label">Kode Penerbangan</label>
                        <input type="text" name="kode_penerbangan" id="kode_penerbangan" class="form-control <?php echo $isKode; ?>" placeholder="Masukkan Kode Penerbangan" value="<?= $data['kode_penerbangan'] ?>" readonly>
                        <div class="invalid-feedback">
                            Kode Penerbangan harus diisi
                        </div>
                        <div class="valid-feedback">
                            Kode penerbangan sudah diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama_maskapai" id="nama" class="form-control <?php echo $isNama ?>" placeholder="Masukkan Nama" value="<?= $data['nama_maskapai'] ?>">
                        <div class="invalid-feedback">
                            Nama harus diisi
                        </div>
                        <div class="valid-feedback">
                            Nama sudah diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control <?php echo $isEmail ?>" placeholder="Masukkan Email" value="<?= $data['email'] ?>">
                        <div class="invalid-feedback">
                            Email harus diisi
                        </div>
                        <div class="valid-feedback">
                            Email sudah diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kata_sandi" class="form-label">Kata Sandi</label>
                        <input type="password" name="kata_sandi" id="kata_sandi" class="form-control <?php echo $isKataSandi ?>" placeholder="Masukkan Kata Sandi" value="<?= $data['kata_sandi'] ?>">
                        <div class="invalid-feedback">
                            Kata sandi harus diisi
                        </div>
                        <div class="valid-feedback">
                            Kata sandi sudah diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_handphone" class="form-label">Nomor Handphone</label>
                        <input type="tel" name="nomor_handphone" id="no_handphone" class="form-control <?php echo $isNoHandphone ?>" placeholder="Masukkan Nomor Handphone" value="<?= $data['nomor_handphone'] ?>">
                        <div class="invalid-feedback">
                            No Handphone harus diisi
                        </div>
                        <div class="valid-feedback">
                            No Handphone sudah diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <?php
                        if ($data['logo'] != NULL) {
                            echo "<img class='img-thumbnail' src='../assets/images/logo/maskapai/" . $data['logo'] . "'width='250'";
                        } else {
                            echo "Logo tidak tersedia";
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control <?php echo $isLogo ?>">
                        <div class="invalid-feedback">
                            Logo harus diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Edit" name="edit" id="edit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        header("Location:index.php");
    }
}
?>