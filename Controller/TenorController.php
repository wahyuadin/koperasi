<?php 
function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function adminData() {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM tenor"));
}

function adminInsert($data) {
    $conn       = globalfun();
    $bulan      = htmlspecialchars($data['bulan']);
    $persen     = htmlspecialchars($data['persen']);
    
    return mysqli_query($conn, "INSERT INTO tenor (bulan,persen) VALUES ('$bulan','$persen')");
}

function adminEdit($data) {
    $conn       = globalfun();
    $id         = htmlspecialchars($data['id']);
    $bulan      = htmlspecialchars($data['bulan']);
    $persen     = htmlspecialchars($data['persen']);

    $query = mysqli_query($conn, "UPDATE tenor SET bulan='$bulan', persen='$persen' WHERE id='$id'");
    if ($query) {
        return $query;
    }
}

function adminHapus($data) {
    $conn       = globalfun();
    $id         = htmlspecialchars($data['id']);

    $query      = mysqli_query($conn, "DELETE FROM tenor WHERE id='$id'");
    if ($query) {
        return $query;
    }
}

?>