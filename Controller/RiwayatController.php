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

function accPemasukan($data) {
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


function accPengeluaran($data) {
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
        if (mysqli_query($conn, "UPDATE riwayat_transaksi SET acc='1' WHERE id_transaksi='$object->id_transaksi'")) {
            date_default_timezone_set('Asia/Jakarta');
            $id             = explode(" ",$result->ket)[0];
            $pinjam         = $result->nominal;
            $result2        = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM tenor WHERE id='$id'"));
            $persen         = $pinjam*$result2->persen/100;
            $rumus          = ($persen * $result2->bulan + $pinjam) / ($result2->bulan);
            $total          = number_format($rumus,0,'.','');
            
            $timestampSaatIni = time();
            $penambahanHari = $result2->bulan*30;
            for ($i = 1; $i <= $result2->bulan; $i++) {
                $timestampSetelahPenambahan = strtotime("+" . $penambahanHari . " days", $timestampSaatIni);
                $tanggalSetelahPenambahan = date("Y-m-d H:i:s", $timestampSetelahPenambahan);
            
                mysqli_query($conn, "INSERT INTO transaksi (id_user,id_transaksi,id_tenor,nominal,timestamp) VALUES ('$result->id_user','$result->id_transaksi','$id','$total','$tanggalSetelahPenambahan')");
                $penambahanHari += 30;
            }
            return mysqli_query($conn, "INSERT INTO master (id_user,id_transaksi,nama,pemasukan,ket) VALUES ('$object->id_user','$object->id_transaksi','$object->nama','$object->nominal','$object->ket')");
        }
    }
}

function reject($data) {
    $conn       = globalfun();
    $id_user    = htmlspecialchars($data['id_transaksi']);

    return mysqli_query($conn, "UPDATE riwayat_transaksi SET acc='3' WHERE id_transaksi='$id_user'");
}

function backup($data) {
    date_default_timezone_set('Asia/Jakarta');
    $id     = htmlspecialchars($data['tenor']);
    $pinjam = htmlspecialchars($data['pinjaman']);
    $conn   = globalfun();
    $result = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM tenor WHERE id='$id'"));
    $persen = $pinjam*$result->persen/100;
    $rumus  = ($persen * $result->bulan + $pinjam) / ($result->bulan);


    $timestampSaatIni = time();
    $penambahanHari = $result->bulan*30;
    for ($i = 1; $i <= $result->bulan; $i++) {
        $timestampSetelahPenambahan = strtotime("+" . $penambahanHari . " days", $timestampSaatIni);
        $tanggalSetelahPenambahan = date("Y-m-d H:i:s", $timestampSetelahPenambahan);
    
        echo "mysqli_query('INSERT INTO users SET nama=aku VALUES (".$tanggalSetelahPenambahan.")')";
        echo "</br>";
        $penambahanHari += 30;
    }
    var_dump($persen*$result->bulan);
    var_dump($pinjam / $result->bulan);
    var_dump(rupiah(number_format($rumus,0,'.','')));
    die;
}
?>