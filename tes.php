<?php
date_default_timezone_set('Asia/Jakarta');
$timestampSaatIni = time();
$penambahanHari = 30;
for ($i = 1; $i <= 6; $i++) {
    $timestampSetelahPenambahan = strtotime("+" . $penambahanHari . " days", $timestampSaatIni);
    $tanggalSetelahPenambahan = date("Y-m-d H:i:s", $timestampSetelahPenambahan);

    echo "mysqli_query('INSERT INTO users SET nama=aku VALUES (".$tanggalSetelahPenambahan.")')";
    echo "<br>";
    $penambahanHari += 30;
}
?>
