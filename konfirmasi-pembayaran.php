<?php
if ($_SESSION['level'] == "pelanggan") {
    if (isset($_POST['konfirmasi'])) {
        $kode_pesanan   = isValidate($_POST['kode_pesanan']);
        $bank_tujuan    = isValidate($_POST['bank_tujuan']);
        $bank_pelanggan = isValidate($_POST['bank_pelanggan']);
        $nama_rekening  = isValidate($_POST['nama_rekening']);
        $no_rekening    = isValidate($_POST['no_rekening']);
        //konfigurasi bukti
        $nama_file          = $_FILES['bukti_transfer']['name'];
        $ukuran_file        = $_FILES['bukti_transfer']['size'];
        $tipe_file          = $_FILES['bukti_transfer']['type'];
        $tmp_file           = $_FILES['bukti_transfer']['tmp_name'];
        $created            = date('Y-m-d H:i:s');
        $update             = date('Y-m-d H:i:s');

        // filter data
        $kode_pesanan = mysqli_real_escape_string($koneksi, $kode_pesanan);
        $bank_tujuan = mysqli_real_escape_string($koneksi, $bank_tujuan);
        $bank_pelanggan = mysqli_real_escape_string($koneksi, $bank_pelanggan);
        $nama_rekening = mysqli_real_escape_string($koneksi, $nama_rekening);
        $no_rekening = mysqli_real_escape_string($koneksi, $no_rekening);
        // lokasi penyimpanan
        $lokasi = "assets/images/pembayaran/buktitf/" . $nama_file;

        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
            if ($ukuran_file <= 1000000) {
                if (move_uploaded_file($tmp_file, $lokasi)) {
                    $query = mysqli_query($koneksi, "INSERT INTO pembayaran VALUES (null,'$kode_pesanan','$bank_tujuan','$bank_pelanggan','$nama_rekening','$no_rekening','$nama_file','0','$created','$update')");
                    if ($query) {
                        header("Location:index.php?menu=pesanan");
                    }
                } else {
                    echo "Gambar gagal di upload";
                }
            } else {
                echo "Ukuran gambar maksimal 1mb";
            }
        } else {
            echo "Tipe gambar tidak didukung";
        }
    }
}
