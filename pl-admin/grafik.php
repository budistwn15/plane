<?php
include('../lib/koneksi.php');

$sql = "Select SUM(jumlah_total) as m, date_format(tanggal,'%Y-%m')as d from transaksi GROUP BY date_format(tanggal,'%Y %m')";
$rs = mysqli_query($koneksi, $sql);
$data = array();
while ($row = mysqli_fetch_object($rs)) {
    $data[] = array(
        'y' => $row->d, //y sebagai kata kunci nya (tahun)  
        'jumlah' => $row->m, //jumlah penjualan
    );
}


//outputkan sebagai json
echo json_encode($data);
