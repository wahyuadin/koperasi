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

// ADMIN
function saldoAdmin() {
    $conn = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as SALDO FROM riwayat_transaksi"));
}

function acc($data) {
    $id = htmlspecialchars($data['id_transaksi']);
    $conn = globalfun();
    $result = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM riwayat_transaksi WHERE id_transaksi='$id'"));
    $array = [
        'id_user'           =>  $result->id_user,
        'id_transaksi'      =>  $result->id_transaksi,
        'nama'              =>  mysqli_fetch_object(mysqli_query($conn, "SELECT users.nama
                                FROM users INNER JOIN riwayat_transaksi ON 
                                riwayat_transaksi.id_user = users.id_user WHERE id_transaksi='$id'"))->nama,
        'nama_transaksi'    =>  $result->kategori,
        'nominal'           =>  $result->nominal,
        'ket'               =>  $result->ket
    ];
    $object = (object)$array;
    $result1 = mysqli_query($conn, "INSERT INTO pemasukan (id_user,id_transaksi,nama,nama_transaksi,nominal,ket) VALUES ('$object->id_user','$object->id_transaksi','$object->nama','$object->nama_transaksi','$object->nominal','$object->ket')");
    if ($result1) {
        mysqli_query($conn, "UPDATE riwayat_transaksi SET acc='1' WHERE id_transaksi='$object->id_transaksi'");
        return mysqli_query($conn, "INSERT INTO master (id_user,id_transaksi,nama,pemasukan,ket) VALUES ('$object->id_user','$object->id_transaksi','$object->nama','$object->nominal','$object->ket')");
    }
}

function reject() {
    
}
?>