<?php
include "lib/koneksi.php";
include "lib/config.php";
include "pl-admin/lib/function.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/logo/Icon-Logo.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/font-awesome/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- css -->
    <link rel="stylesheet" href="assets/css/dark-mode.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery.convform.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <title>Plane - Beli Tiket Murah</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="<?= SITEURL ?>">
                <img src="assets/images/logo/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="<?= SITEURL ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITEURLMENU ?>bantuan">Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITEURLMENU ?>kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <div class="form-check form-switch my-2 mx-2">
                            <input type="checkbox" class="form-check-input" id="darkSwitch">
                            <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                        </div>
                    </li>
                    <?php
                    if (isset($_SESSION['level']) == "pelanggan") {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITEURLMENU ?>pesanan">My Order
                            </a>
                        </li>
                        <?php
                        if (isset($_SESSION['ab']) && isset($_SESSION['ad'])) {
                        ?>
                            <li class="nav-item">
                                <a href="<?= SITEURLMENU ?>profile" class="btn btn-primary rounded-circle ms-2"><?= strtolower($_SESSION['ad']) . strtolower($_SESSION['ab']); ?></a>
                            </li>
                        <?php
                        }
                    } else if (isset($_SESSION['level']) == "") {
                        ?>
                        <!-- desktop -->
                        <form class="d-flex d-none d-md-block">
                            <a href="login.php" class="btn btn-primary btn-navbar-right ms-4">Login</a>
                            <a href="register.php" class="btn btn-outline-primary btn-navbar-right ms-2">Daftar</a>
                        </form>
                        <!-- mobile -->
                        <form class="d-grid gap-2 d-sm-block d-md-none">
                            <button class="btn btn-primary">Login</button>
                            <button class="btn btn-outline-primary">Daftar</button>
                        </form>
                    <?php
                    }
                    ?>



                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <?php
    include "lib/menu.php";
    ?>

    <section class="footer border-top mt-3">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4">
                    <img src="assets/images/logo/logo.png" alt="">
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-2">Location</h5>
                    <p>PT Plane Indonesia Sejahtera</p>
                    <p>Jln. Syeh Quro No 103</p>
                    <p>Karawang, Indonesia</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-2">Say Hello</h5>
                    <p>info@plane.com</p>

                </div>
            </div>
            <div class="row">
                <p class="text-center">Copyright 2021 All Right Reserved | By <span class="text-primary">Plane.com</span></p>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <img src="assets/images/background/notify.png" class="rounded mx-auto d-block img-responsive" width="250" alt="">
                        <h5 class="text-dark fw-lighter text-center">Apakah anda yakin keluar ?</h5>
                        <p class="text-muted text-center">Anda tidak dapat mengembalikan ini</p>
                        <div class="d-flex justify-content-center">
                            <a href="logout.php" class="btn btn-primary rounded-0 me-3">Keluar</a>
                            <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/dark-mode-switch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="assets/js/autosize.min.js"></script>
    <script src="assets/js/jquery.convform.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Pesan',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['help']]
            ]
        });
        var typed = new Typed('#typed', {
            strings: ['Kemana ?', 'Cari Tiket Pesawat Murah dan Mudah'],
            typeSpeed: 60,
            startDelay: 60,
            loop: true
        });

        AOS.init({
            duration: 800,
            once: true,
        });
        gsap.from('.navbar', {
            duration: 1.5,
            y: '-100%',
            opacity: 0,
            ease: 'bounce'
        });

        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function google(stateWrapper, ready) {
            window.open("https://google.com");
            ready();
        }

        function bing(stateWrapper, ready) {
            window.open("https://bing.com");
            ready();
        }
        var rollbackTo = false;
        var originalState = false;

        function storeState(stateWrapper, ready) {
            rollbackTo = stateWrapper.current;
            console.log("storeState called: ", rollbackTo);
            ready();
        }

        function rollback(stateWrapper, ready) {
            console.log("rollback called: ", rollbackTo, originalState);
            console.log("answers at the time of user input: ", stateWrapper.answers);
            if (rollbackTo != false) {
                if (originalState == false) {
                    originalState = stateWrapper.current.next;
                    console.log('stored original state');
                }
                stateWrapper.current.next = rollbackTo;
                console.log('changed current.next to rollbackTo');
            }
            ready();
        }

        function restore(stateWrapper, ready) {
            if (originalState != false) {
                stateWrapper.current.next = originalState;
                console.log('changed current.next to originalState');
            }
            ready();
        }
        jQuery(function($) {
            convForm = $('#chat').convform({
                selectInputStyle: 'disable'
            });
            console.log(convForm);
        });
    </script>
</body>

</html>