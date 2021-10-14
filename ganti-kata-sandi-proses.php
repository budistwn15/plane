<?php
if (isset($_POST['simpan'])) {
    $id = isValidate($_POST['id']);
    $password_lama = isValidate($_POST['password_lama']);
    $password_baru = isValidate($_POST['password_baru']);

    $password_lama = sha1($password_lama);
    $password_baru = sha1($password_baru);

    $cek = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'");
    $data = mysqli_fetch_array($cek);

    if ($password_lama == $data['kata_sandi']) {
        $query = mysqli_query($koneksi, "UPDATE pelanggan SET kata_sandi='$password_baru' WHERE id='$id'");
        if ($query) {
            $pesan = "Berhasil merubah kata sandi";
            $pesan = urlencode($pesan);
            header("Location:index.php?menu=ganti-kata-sandi&pesan={$pesan}");
        } else {
            $pesan_error = "Gagal merubah password";
            $pesan_error = urlencode($pesan_error);
            header("Location:index.php?menu=profile&pesan_error={$pesan_error}");
        }
    } else {
        $pesan_error = "Gagal merubah password, password tidak sama";
        $pesan_error = urlencode($pesan_error);
        header("Location:index.php?menu=ganti-kata-sandi&pesan_error={$pesan_error}");
    }
}
