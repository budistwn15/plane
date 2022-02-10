<?php
if ($_SESSION['level'] == "admin") {
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Laporan</h1>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card bg-white p-4 shadow-sm mt-4 border-0">
                <h4 class="fw-bold text-dark">Filter Data</h4>
                <form action="laporan/detail.php" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label text-dark" for="dari">Dari</label>
                        <div class="col-sm-10">
                            <input type="date" name="dari" id="dari" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label text-dark" for="sampai">Sampai</label>
                        <div class="col-sm-10">
                            <input type="date" name="sampai" id="sampai" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="submit" value="Tampilkan" name="tampilkan" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-4">
            <img src="../assets/images/background/laporan.png" alt="" width="500" class="img-responsive">
        </div>
    </div>
<?php
} else {
    header("Location:index.php");
}
?>