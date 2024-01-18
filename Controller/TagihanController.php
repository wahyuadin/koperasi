<?php 

function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

// ADMIN
function countAdmin() {
    $conn = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as SALDO FROM transaksi"));
}

function bayar($data) {
    $conn   = globalfun(); 
    $id     = htmlspecialchars($data['id_transaksi']);
    return mysqli_query($conn, "UPDATE transaksi SET acc='1' WHERE id='$id'");
}


function reject($data) {
    $conn   = globalfun(); 
    $id     = htmlspecialchars($data['id_transaksi']);
    return mysqli_query($conn, "UPDATE transaksi SET acc='3' WHERE id='$id'");
}

// NASABAH
function bayarNasabah($data) {
    $conn   = globalfun(); 
    $id     = htmlspecialchars($data['id_transaksi']);
    return mysqli_query($conn, "UPDATE transaksi SET acc='1' WHERE id_user='$id'");
}


function rejectNasabah($data) {
    $conn   = globalfun(); 
    $id     = htmlspecialchars($data['id_transaksi']);
    return mysqli_query($conn, "UPDATE transaksi SET acc='3' WHERE id_user='$id'");
}

?>