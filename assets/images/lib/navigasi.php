<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #2E4DD4 !important;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-plane"></i>
        </div>
        <h4 class="sidebar-brand-text mx-3 fw-bold">PLANE</h4>
    </a>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    <?php
    if ($_SESSION['level'] == "admin") {
    ?>
        <li class="nav-item ">
            <a class="nav-link" href="index.php?menu=maskapai">
                <i class="fas fa-plane"></i>
                <span>Maskapai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SITEURLMENU ?>jadwal">
                <i class="fas fa-calendar"></i>
                <span>Jadwal</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SITEURLMENU ?>transaksi">
                <i class="fas fa-shopping-basket"></i>
                <span>Transaksi</span></a>
        </li>
        <li class="nav-item">
            <?php
            include "../lib/koneksi.php";
            $jumlah_konfirmasi  = mysqli_query($koneksi, "SELECT * FROM pembayaran");
            $jml                = mysqli_num_rows($jumlah_konfirmasi);
            ?>
            <a class="nav-link" href="<?= SITEURLMENU ?>konfirmasi">
                <i class="fas fa-shopping-basket"></i>
                <span>Konfirmasi <small class="badge bg-white text-danger"><?= $jml; ?></small></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SITEURLMENU ?>laporan">
                <i class="fas fa-file"></i>
                <span>Laporan</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SITEURLMENU ?>pelanggan">
                <i class="fas fa-users"></i>
                <span>Pelanggan</span></a>
        </li>

        <li class="nav-item">
            <a href="<?= SITEURLMENU ?>profile" class="nav-link">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
    <?php
    } else if ($_SESSION['level'] == "maskapai") {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= SITEURLMENU ?>jadwal">
                <i class="fas fa-calendar"></i>
                <span>Jadwal</span></a>
        </li>
    <?php
    }
    ?>
    <li class="nav-item">
        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>