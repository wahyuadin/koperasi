<?php


// NASABAH
function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function saldoNasabah($data) {
    $conn = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as SALDO FROM riwayat_transaksi WHERE id_user='$data'"));
}


?>