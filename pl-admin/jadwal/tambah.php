<?php
$bandara    = "../json/bandara.json";
$file       = file_get_contents($bandara);
$data       = json_decode($file, true);
if ($_SESSION['level'] == "maskapai") {
    if (isset($_POST['tambah'])) {
        $kode_penerbangan = isValidate($_POST['kode_penerbangan']);
        $kode_registrasi = isValidate($_POST['kode_registrasi']);
        $dari = isValidate($_POST['dari']);
        $ke = isValidate($_POST['ke']);
        $keberangkatan = isValidate($_POST['keberangkatan']);
        $kedatangan = isValidate($_POST['kedatangan']);
        $perjalanan = isValidate($_POST['perjalanan']);
        $jumlah_kursi = isValidate($_POST['jumlah_kursi']);
        $jam_keberangkatan = isValidate($_POST['jam_keberangkatan']);
        $jam_kedatangan = isValidate($_POST['jam_kedatangan']);
        $harga = isValidate($_POST['harga']);

        // pajak dari dan pajak ke
        foreach ($data as $pajak_bandara) {
            if ($pajak_bandara['kode'] == $dari) {
                $pjk_dari = $pajak_bandara['pajak'];
            } else if ($pajak_bandara['kode'] == $ke) {
                $pjk_ke = $pajak_bandara['pajak'];
            }
        }

        // total pajak
        $total_pajak = $pjk_dari + $pjk_ke;

        // total harga
        $total_harga = $harga + $total_pajak;

        $query = createData(
            $koneksi,
            "jadwal",
            [
                'id' => null,
                'kode_penerbangan' => $kode_penerbangan,
                'kode_registrasi' => $kode_registrasi,
                'dari' => $dari,
                'ke' => $ke,
                'keberangkatan' => $keberangkatan,
                'kedatangan' => $kedatangan,
                'perjalanan' => $perjalanan,
                'jumlah_kursi' => $jumlah_kursi,
                'jam_keberangkatan' => $jam_keberangkatan,
                'jam_kedatangan' => $jam_kedatangan,
                'harga' => $harga,
                'pajak' => $total_pajak,
                'total_harga' => $total_harga
            ]
        );
        redirectURL($query, "jadwal");
    }
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bold" style="color: #2E4765;">Jadwal</h1>
    </div>
    <div class="row">
        <div class="card bg-white p-4 shadow">
            <h4 class="h4 fw-bold" style="color: #2E4765;">Tambah Jadwal</h4>
            <p>Silahkan untuk menambah jadwal penerbangan</p>
            <form action="" method="POST">
                <div class="mb-3 row">
                    <label for="kode_penerbangan" class="col-sm-2 col-form-label">Kode Penerbangan</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" name="kode_penerbangan" id="kode_penerbangan" value="<?= $_SESSION['kode'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kode_registrasi" class="col-sm-2 col-form-label">Kode Registrasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kode_registrasi" id="kode_registrasi">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="dari" class="col-sm-2 col-form-label">Dari</label>
                    <div class="col-sm-10">
                        <select name="dari" id="dari" class="form-select">
                            <optgroup label="Pilih Kota">
                                <?php
                                sort($data);
                                foreach ($data as $dari) { ?>
                                    <option value="<?= $dari['kode'] ?>"><?= $dari['kode'] . " - " . $dari['nama']; ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="ke" class="col-sm-2 col-form-label">Ke</label>
                    <div class="col-sm-10">
                        <select name="ke" id="ke" class="form-select">
                            <optgroup label="Pilih Kota">
                                <?php
                                rsort($data);
                                foreach ($data as $ke) { ?>
                                    <option value="<?= $ke['kode'] ?>"><?= $ke['kode'] . " - " . $ke['nama']; ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_keberangkatan" class="col-sm-2 col-form-label">Keberangkatan</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="keberangkatan" id="keberangkatan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_kedatangan" class="col-sm-2 col-form-label">Kedatangan</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="kedatangan" id="kedatangan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="perjalanan" class="col-sm-2 col-form-label">Perjalanan</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="perjalanan" id="sekali-jalan" class="form-check-input" value="Sekali Jalan">
                            <label for="sekali-jalan" class="form-check-label">Sekali Jalan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="perjalanan" id="transit" class="form-check-input" value="Transit">
                            <label for="transit" class="form-check-label">Transit</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah_kursi" class="col-sm-2 col-form-label">Jumlah Kursi</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="jumlah_kursi" id="jumlah_kursi" value="0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jam_keberangkatan" class="col-sm-2 col-form-label">Jam Keberangkatan</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="jam_keberangkatan" id="jam_keberangkatan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jam_kedatangan" class="col-sm-2 col-form-label">Jam Kedatangan</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="jam_kedatangan" id="jam_kedatangan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" value="0" class="form-control" name="harga" id="harga">
                    </div>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Tambah" class="btn btn-primary" name="tambah">
                </div>
            </form>
        </div>
    </div>
<?php
} else {
    header("Location:index.php");
}
?>