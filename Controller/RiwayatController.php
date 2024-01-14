<?php

function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

?>