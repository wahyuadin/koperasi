<?php 
function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function adminPemasukan() {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, 'SELECT SUM(nominal) as SALDO FROM pemasukan;'));
    
}

function adminData() {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM pemasukan'));
}

function adminInsert($data) {
    $conn       = globalfun();
    $nama       = htmlspecialchars($data['nama']);
    $nominal    = htmlspecialchars($data['nominal']);
    $ket        = htmlspecialchars($data['ket']);

    $query = mysqli_query($conn, "SELECT RIGHT(id_user, 3) as kode FROM users ORDER BY id_user DESC LIMIT 1");
        $result = $query->fetch_object();
        if ($result) {
            $kode = intval($result->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, rand(5, 998), STR_PAD_LEFT);
        $kodejadi = "TRS-" . $kodemax;
        $id_user = $_SESSION['users']->id_user;

    $result1 = mysqli_query($conn, "INSERT INTO pemasukan (id_user,id_transaksi,nama,nominal,ket) VALUES ('$id_user','$kodejadi','$nama','$nominal','$ket')");
    if ($result1) {
        return mysqli_query($conn, "INSERT INTO master (id_user,id_transaksi,nama,pemasukan,ket) VALUES ('$id_user','$kodejadi','$nama','$nominal','$ket')");
    }
}


function adminHapus($id) {
    $conn= globalfun();
    $id = $id['id'];
    $result =  mysqli_query($conn,"DELETE FROM pemasukan WHERE id_transaksi = '$id'");  
    if ($result) {
        return mysqli_query($conn,"DELETE FROM master WHERE id_transaksi = '$id'");  
    }
}

function adminEdit($data) {
    $conn       = globalfun();
    $id         = htmlspecialchars($data['id']);
    $nama       = htmlspecialchars($data['nama']);
    $nominal    = htmlspecialchars($data['nominal']);
    $ket        = htmlspecialchars($data['ket']);
    
    $result = mysqli_query($conn, "UPDATE pemasukan SET nama = '$nama', nominal='$nominal', ket = '$ket'  WHERE id_transaksi = '$id'");
    if ($result) {
        return mysqli_query($conn, "UPDATE master SET nama = '$nama', pemasukan='$nominal', ket = '$ket'  WHERE id_transaksi = '$id'");
    }
}


// NASABAH

function nasabahPemasukan($data) {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as SALDO FROM pemasukan WHERE id_user='$data'"));
    
}

function nasabahData($data) {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM pemasukan WHERE id_user='$data'"));
}

function nasabahInsert($data) {
    $conn       = globalfun();
    $nama       = htmlspecialchars($data['nama']);
    $nominal    = htmlspecialchars($data['nominal']);
    $ket        = htmlspecialchars($data['ket']);

    $query = mysqli_query($conn, "SELECT RIGHT(id_user, 3) as kode FROM users ORDER BY id_user DESC LIMIT 1");
        $result = $query->fetch_object();
        if ($result) {
            $kode = intval($result->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, rand(5, 998), STR_PAD_LEFT);
        $kodejadi = "TRS-" . $kodemax;
        $id_user = $_SESSION['nasabah']->id_user;

    return mysqli_query($conn, "INSERT INTO riwayat_transaksi (id_user,id_transaksi,kategori,nominal,ket) VALUES ('$id_user','$kodejadi','pemasukan','$nominal','$ket')");
}
?>  