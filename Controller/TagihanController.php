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
    $conn           = globalfun();
    $id_user        = $data['nasabah']->id_user; 
    $result         = mysqli_fetch_object(mysqli_query($conn, "SELECT transaksi.id_transaksi, transaksi.nominal,
	tenor.bulan, tenor.persen, tenor.id, transaksi.timestamp, transaksi.acc, transaksi.id
	FROM transaksi
	INNER JOIN tenor ON tenor.id = transaksi.id_tenor WHERE id_user='$id_user'"));
    $query = mysqli_query($conn, "INSERT INTO riwayat_transaksi (id_user,id_transaksi,kategori,nominal,ket,acc)
            VALUES ('$id_user','$result->id_transaksi','pengeluaran','$result->nominal','$result->id - kredit $result->bulan bulan, $result->persen %','0')");
    if ($query) {
        return mysqli_query($conn, "UPDATE transaksi SET acc='9' WHERE id = '$result->id'");
    }
}


function rejectNasabah($data) {
    $conn   = globalfun(); 
    $id     = htmlspecialchars($data['id_transaksi']);
    return mysqli_query($conn, "UPDATE transaksi SET acc='3' WHERE id_user='$id'");
}

?>