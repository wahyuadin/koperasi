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

?>