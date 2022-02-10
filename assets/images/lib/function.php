<?php
function isLoginSessionExpired()
{
    $session_duration = 10;
    $current_time = time();
    if (isset($_SESSION['logged_time']) && isset($_SESSION['id'])) {
        if (((time() - $_SESSION['logged_time']) > $session_duration)) {
            return true;
        }
    }
    return false;
}

function isValidate($data)
{
    $data = htmlentities($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    $data = trim($data);
    return $data;
}

function isEmpty($data, $isData)
{
    if (empty($data)) {
        $isData = "is-invalid";
        return $isData;
    } else {
        $isData = "is-valid";
        return $isData;
    }
}

function allData($koneksi, $tableName)
{
    $data = mysqli_query($koneksi, "SELECT * FROM $tableName");
    while ($row = mysqli_fetch_array($data)) {
        $hasil[] = $row;
    }
    return $hasil;
}

function orderData($koneksi, $tableName, $primaryKey, $order)
{
    return mysqli_query($koneksi, "SELECT * FROM $tableName ORDER BY $primaryKey $order");
}

function showDataPrimary($koneksi, $tableName, $fieldName, $primaryKey)
{
    return mysqli_query($koneksi, "SELECT * FROM $tableName WHERE $fieldName='$primaryKey'");
}

function createData($koneksi, $tableName, array $data)
{
    $fields = $data;
    $sql = '"' . join('","', $fields) . '"';
    return mysqli_query($koneksi, "INSERT INTO $tableName VALUES ($sql)");
}



function getPrimary($primaryKey)
{
    $primaryKey = $_GET['$primaryKey'];
    return $primaryKey;
}

function redirectURL($title, $link)
{
    if ($title) {
        header("Location:" . SITEURLMENU . "$link");
    } else {
        echo "Gagal";
    }
}

function redirectURLMessage($title, $link, $message)
{
    if ($title) {
        $pesan = "$message";
        $pesan = urlencode($pesan);
        header("Location:" . SITEURLMENU . "$link" . "&pesan={$pesan}");
    } else {
        echo "Gagal";
    }
}

function redirectUser($title, $link)
{
    if ($title) {
        header("Location:" . "$link");
    } else {
        echo "Gagal";
    }
}

function deleteData($koneksi, $tableName, $fieldName, $primaryKey)
{
    return mysqli_query($koneksi, "DELETE FROM $tableName WHERE $fieldName='$primaryKey'");
}
