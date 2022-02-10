<?php
include "../lib/config.php";
include "lib/function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Plane adalah website untuk memesan tiket pesawat">
    <meta name="author" content="Budi Setiawan">
    <title>Dashboard - Plane</title>
    <link rel="shortcut icon" href="../assets/images/logo/Icon-Logo.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/Bootstrap/css/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="../assets/vendor/font-awesome/all.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body id="page-top">
    <?php
    session_start();
    if ($_SESSION['level'] == "") {
        header("Location:../login.php");
    }
    ?>

    <div id="wrapper">
        <?php
        include "lib/navigasi.php";
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="bg-white">
                <div class="container-fluid mt-3">
                    <?php
                    include "lib/menu.php";
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- modal logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <img src="../assets/images/background/notify.png" class="rounded mx-auto d-block img-responsive" width="250" alt="">
                        <h5 class="text-dark fw-lighter text-center">Apakah anda yakin keluar ?</h5>
                        <p class="text-muted text-center">Anda tidak dapat mengembalikan ini</p>
                        <div class="d-flex justify-content-center">
                            <a href="../logout.php" class="btn btn-primary rounded-0 me-3">Keluar</a>
                            <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal hapus -->
    <div class="modal fade" id="hapusMaskapai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <img src="../assets/images/background/notify.png" class="rounded mx-auto d-block img-responsive" width="250" alt="">
                        <h5 class="text-dark fw-lighter text-center">Apakah anda yakin ?</h5>
                        <p class="text-muted text-center">Anda tidak dapat mengembalikan ini</p>
                        <div class="d-flex justify-content-center">
                            <a href="<?= SITEURLMENU . "maskapai-hapus&kode_penerbangan=" . $data['kode_penerbangan']; ?>" class="btn btn-primary rounded-0 me-3">Hapus</a>
                            <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal hapus pelanggan -->
    <div class="modal fade" id="hapusPelanggan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <img src="../assets/images/background/notify.png" class="rounded mx-auto d-block img-responsive" width="250" alt="">
                        <h5 class="text-dark fw-lighter text-center">Apakah anda yakin ?</h5>
                        <p class="text-muted text-center">Anda tidak dapat mengembalikan ini</p>
                        <div class="d-flex justify-content-center">
                            <a href="<?= SITEURLMENU . "pelanggan-hapus&id=" . $data['id']; ?>" class="btn btn-primary rounded-0 me-3">Hapus</a>
                            <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetail<?= $maskapai['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <?php
            $id = $maskapai['id'];
            $query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id='$id'");
            $data = mysqli_fetch_assoc($query);
            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jadwal penerbangan : <?= $data['kode_registrasi']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table text-dark">
                        <tr>
                            <th>Kode Penerbangan</th>
                            <td><?= $data['kode_penerbangan']; ?></td>
                        </tr>
                        <tr>
                            <th>Kode Registrasi</th>
                            <td><?= $data['kode_registrasi']; ?></td>
                        </tr>
                        <tr>
                            <th>Dari</th>
                            <td><?= $data['dari']; ?></td>
                        </tr>
                        <tr>
                            <th>Ke</th>
                            <td><?= $data['ke']; ?></td>
                        </tr>
                        <tr>
                            <th>Keberangkatan</th>
                            <td><?= $data['keberangkatan']; ?></td>
                        </tr>
                        <tr>
                            <th>Kedatangan</th>
                            <td><?= $data['kedatangan']; ?></td>
                        </tr>
                        <tr>
                            <th>Perjalanan</th>
                            <td><?= $data['perjalanan']; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Kursi</th>
                            <td><?= $data['jumlah_kursi']; ?></td>
                        </tr>
                        <tr>
                            <th>Jam Keberangkatan</th>
                            <td><?= $data['jam_keberangkatan']; ?></td>
                        </tr>
                        <tr>
                            <th>Jam Kedatangan</th>
                            <td><?= $data['jam_kedatangan']; ?></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td><?= "Rp. " . number_format($data['harga'], "0", ".", "."); ?></td>
                        </tr>
                        <tr>
                            <th>Pajak</th>
                            <td><?= "Rp. " . number_format($data['pajak'], "0", ".", "."); ?></td>
                        </tr>
                        <tr>
                            <th>Total Harga</th>
                            <td><?= "Rp. " . number_format($data['total_harga'], "0", ".", "."); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $nama_maskapai = "";
    $jumlah = null;

    $sql = "SELECT nama_maskapai, count(*) AS total FROM jadwal INNER JOIN maskapai ON maskapai.kode_penerbangan=jadwal.kode_penerbangan";
    $hasil = mysqli_query($koneksi, $sql);

    while ($data = mysqli_fetch_array($hasil)) {
        $mas = $data['nama_maskapai'];
        $nama_maskapai .= "'$mas'" . ",";

        $jum = $data['total'];
        $jumlah .= "$jum" . ",";
    }
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../assets/vendor/Bootstrap/js/bootstrap.min.js"></script>
    <script>
        // Tabel Maskapai
        $(document).ready(function() {
            $("#maskapaiTable").dataTable();
        });
        // Tabel Jadwal
        $(document).ready(function() {
            $("#jadwalTable").dataTable();
        });
        // Tabel Transaksi
        $(document).ready(function() {
            $("#transaksiTable").dataTable();
        });
        // Tabel Pelanggan
        $(document).ready(function() {
            $("#pelangganTable").dataTable();
        });

        function realisasi() {

            $("#response").hide(); //sebagai div response

            $.ajax({
                url: "grafik.php", //ambil data dari data.php
                cache: false, //data ga di simpan ke browser
                type: "GET", //tipe sinkron GET
                dataType: "json", //data tipe nya sebagai json
                timeout: 3000, //set 3 detik respon, jika lama berarti gagal
                beforeSend: function() {

                    $("#response").show(); // munculkan image loading
                },
                success: function(data) {

                    $("#response").hide(); //image loading dimatikan :( 
                    var graph = Morris.Line({ //inisialkan graph sebagai morris chart area
                        element: 'myfirstchart', //masukin chart nya nanti di div id=contoh-chart
                        data: data, //set data dari callback success function
                        xkey: 'y', //ini yang tadi sebagai data x (bawah)
                        ykeys: ['jumlah'], //datanya berupa jumlah penjualan tadi, json data
                        labels: ['Jumlah Total'], //Label data dibikin Penjualan      
                        lineColors: ['#2b44d2'], //bikin warna line nya
                    });
                }
            });
        }
        $(document).ready(function() {
            realisasi(); // nanti dipanggil di sini
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [<?php echo $nama_maskapai ?>],
                datasets: [{
                    // label: '# Jumlah Penerbangan Maskapai',
                    data: [<?php echo $jumlah ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
        });
    </script>
</body>

</html>