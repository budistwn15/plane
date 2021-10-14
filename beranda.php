<?php
$bandara    = "json/bandara.json";
$file       = file_get_contents($bandara);
$data       = json_decode($file, true);
$now = date('Y-m-d');
?>
<div class="sky">
    <div class="clouds"></div>

    <div class="airplane">
        <img src="https://i.ibb.co/SPpRcJz/airplane.png">

        <div class="flame"></div>
        <div class="flame flame2"></div>
    </div>
    <button class="btn btn-light shadow-lg fw-bold open-button border-start border-warning" data-bs-toggle="modal" data-bs-target="#bantuanModal"><i class="far fa-question-circle"></i> Pusat Bantuan</button>
    <div class="mountains"></div>
    <div class="container py-5">
        <form action="search.php" method="POST">
            <div class="row ">
                <div class="col-8 py-5 mt-5">
                    <h2 class="text-white fw-bold mt-4" data-aos="fade-right">Hey, kamu</h2>
                    <h2 class="text-white" data-aos="fade-right">Mau <span id="typed"></span></h2>
                    <div class="row g-3 mt-3">
                        <div class="col">
                            <div class="form-floating" data-aos="fade-right">
                                <select class="form-select border-warning border-0 border-start border-4" id="dari" aria-label="Floating label select example" name="dari">
                                    <?php
                                    sort($data);
                                    foreach ($data as $dari) { ?>
                                        <option value="<?= $dari['kode'] ?>"><?= $dari['kota'] . " - " . $dari['kode']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="dari">Dari</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating" data-aos="fade-left">
                                <select class="form-select border-warning border-0 border-start border-4" id="ke" name="ke" aria-label="Floating label select example">
                                    <?php
                                    rsort($data);
                                    foreach ($data as $ke) { ?>
                                        <option value="<?= $ke['kode'] ?>"><?= $ke['kota'] . " - " . $ke['kode']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="ke">Ke</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col">
                            <div class="form-floating" data-aos="fade-right">
                                <input type="date" name="keberangkatan" id="keberangkatan" class="form-control border-0 border-start border-warning border-4" placeholder="Masukkan Tanggal" min="<?= $now ?>" required>
                                <label for="keberangkatan">Berangkat</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating" data-aos="fade-left">
                                <input type="date" name="kedatangan" id="kedatangan" class="form-control border-0 border-start border-warning border-4" placeholder="Masukkan Tanggal" min="<?= $now ?>" required>
                                <label for="kedatangan">Pulang</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col">
                            <input class="btn btn-warning rounded-3 text-white" value="Cari Penerbangan" type="submit" name="cari" data-aos="fade-right">
                        </div>
                    </div>
        </form>
    </div>
</div>

</div>

</div>


<section class="Our-Networks py-5" data-aos="fade-in">
    <div class="container">
        <h2 class="text-center fw-bold pt-5">Kemudahan itu ada tiketnya!</h2>
        <div class="row mt-5">
            <div class="col-md-4" data-aos="flip-up">
                <div class="card border-0 card-dark" style="width: 18rem;">
                    <img src="assets/images/background/easy-ticket.png" class="d-flex m-auto" alt="..." width="100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center">Mudahnya Pesan Tiket</h5>
                        <p class="card-text text-center">Pesan tiket di plane sangat mudah, hanya dengan satu sentuhan
                            jari, tiket yang kamu butuhkan bisa didapatkan dengan mudah</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up">
                <div class="card border-0 card-dark" style="width: 18rem;">
                    <img src="assets/images/background/various-products.png" class="d-flex m-auto" alt="..." width="100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center">Banyak Pilihan Maskapai</h5>
                        <p class="card-text text-center">Ada banyak pilihan maskapai yang tersedia di plane dan dengan
                            rute yang lumayan banyak</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up">
                <div class="card border-0 card-dark" style="width: 18rem;">
                    <img src="assets/images/background/customer-service.png" class="d-flex m-auto" alt="..." width="100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center">24/7 Customer Care</h5>
                        <p class="card-text text-center">Melalui pelayanan 24/7 Customer care, plane akan selalu ada
                            buat kamu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="maskapai mt-5">
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4" data-aos="fade-right">
                <h4 class="fw-bold">Partner Maskapai</h4>
                <p class="lead text-secondary">Plane bekerja sama dengan berbagai maskapai penerbangan di seluruh
                    indonesia untuk menerbangkan anda ke mana pun anda inginkan!</p>
            </div>
            <div class="col-md-8">
                <ul class="list-group list-group-horizontal">
                    <?php
                    $maskapai = mysqli_query($koneksi, "SELECT logo FROM maskapai");
                    foreach ($maskapai as $mas) {
                    ?>
                        <li class="list-group-item border-0">
                            <?php
                            if ($mas['logo'] != NULL) {
                                echo "<img src='assets/images/logo/maskapai/" . $mas['logo'] . "'width='80' class=\"img-fluid\" data-aos=\"zoom-in-right\">";
                            } else {
                                echo "Logo tidak tersedia";
                            }
                            ?>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-4" data-aos="fade-right">
                <h4 class="fw-bold">Partner Pembayaran Resmi</h4>
                <p class="lead text-secondary">Plane bekerja sama dengan beragam penyedia layanan pembayaran terpercaya
                    supaya anda bisa bertransaksi dengan aman dan lancar!</p>
            </div>
            <div class="col-md-8">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item border-0"><img src="assets/images/pembayaran/depan/mandiri.png" class="img-fluid mt-3" data-aos="zoom-in-right"></li>
                    <li class="list-group-item border-0"><img src="assets/images/pembayaran/depan/bca.png" class="img-fluid mt-1" data-aos="zoom-in-right"></li>
                    <li class="list-group-item border-0"><img src="assets/images/pembayaran/depan/bni.png" class="img-fluid mt-1" data-aos="zoom-in-right"></li>
                    <li class="list-group-item border-0"><img src="assets/images/pembayaran/depan/bri.png" class="img-fluid mt-3" data-aos="zoom-in-right"></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="bantuanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pusat Bantuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="chat" class="conv-form-wrapper">
                    <form action="" method="GET" class="hidden">
                        <select data-conv-question="Hello! Selamat datang di Pusat Bantuan Plane! Anda ingin meminta bantuan ?" name="first-question">
                            <option value="yes">Iya</option>
                            <option value="sure">Iya Dong!</option>
                        </select>
                        <input type="text" name="name" data-conv-question="Baik! Pertama, beri tahu nama lengkapmu. | Oke! Tolong, beri tahu saya nama Anda dulu.">
                        <input type="text" data-conv-question="Hallo, <b>{name}:0</b>! Senang berkenalan dengan anda (Perhatikan bahwa pertanyaan ini tidak mengharapkan jawaban apapun)" data-no-answer="true">
                        <input type="text" data-conv-question="Daftar Menu Bantuan <br>
                        <ol> 
                            <li> <b>Akun</b> <ul> 
                                <li>Cara Mendaftar </li> 
                                <li> Lupa Password </li>
                            </ul></li> 
                            <li> <b>Pemesanan</b> 
                            <ul>
                            <li>Mencari Tiket Pesawat</li>
                            <li>Memesan Tiket Pesawat</li> 
                            <li>Pembayaran Yang Tersedia</li> 
                </ul>
                            </li>
                            <li><b>Tiket</b> 
                            <ul>
                                <li>Mencetak E-Ticket</li> </ul> </li> </ol>" data-no-answer="true">
                        <select name="question" data-callback="storeState" data-conv-question="Berikut daftar menu bantuan yang bisa anda pilih">
                            <option value="akun_question">Akun</option>
                            <option value="pemesanan_question">Pemesanan</option>
                            <option value="tiket_question">Tiket</option>
                        </select>
                        <div data-conv-fork="question">
                            <div data-conv-case="akun_question">
                                <select name="akun" data-callback="storeState" data-conv-question="Berikut daftar bantuan yang ada pada menu akun">
                                    <option value="register">Cara Mendaftar</option>
                                    <option value="forgot_password">Lupa Password</option>
                                </select>
                            </div>
                            <div data-conv-case="pemesanan_question">
                                <select name="pemesanan" data-callback="storeState" data-conv-question="Berikut daftar bantuan yang ada pada menu pemesanan">
                                    <option value="mencari">Mencari Tiket</option>
                                    <option value="memesan">Memesan Tiket</option>
                                    <option value="pembayaran">Pembayaran Tersedia</option>
                                </select>
                            </div>
                            <div data-conv-case="tiket_question">
                                <select name="tiket" data-callback="storeState" data-conv-question="Berikut daftar bantuan yang ada pada menu tiket">
                                    <option value="mencari">Mencetak E-Ticket</option>
                                </select>
                            </div>
                        </div>
                        <select data-conv-question="Ada yang ingin anda cari lagi ?" name="last-question">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <div data-conv-fork="last-question">
                            <div data-conv-case="yes">
                                <select name="programmer" data-callback="storeState" data-conv-question="Berikut daftar bantuan yang bisa anda pilih)">
                                    <option value="daftar">Cara Daftar</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div data-conv-case="no">
                                <select data-conv-question="Terimakasih {name}! Mohon maaf jika yang kamu cari tidak ada, Silahkan untuk menghubungi customer service kami di <a href='http://localhost/praktikum/4c/plane/index.php?menu=kontak'>Kontak</a>" id="">
                                    <option value="">Bye Bye!</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <section class="about">
    <div class="container">
        <div class="row p-4">
            <h2 class="fw-bold text-center">Our Team Member</h2>
            <p class="lead text-center">Meet Our Perfectionist</p>
            <div class="col-md-4">
                <div class="card p-4 border-0" style="width: 18rem;">
                    <img src="assets/images/budi.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Budi Setiawan</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 border-0" style="width: 18rem;">
                    <img src="assets/images/budi.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Budi Setiawan</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 border-0" style="width: 18rem;">
                    <img src="assets/images/budi.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Budi Setiawan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->