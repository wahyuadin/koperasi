<?php 
function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function adminPengeluaran() {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, 'SELECT SUM(nominal) as SALDO FROM pengeluaran;'));
    
}

function adminData() {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM pengeluaran'));
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

    $result1 = mysqli_query($conn, "INSERT INTO pengeluaran (id_user,id_transaksi,nama,nominal,ket) VALUES ('$id_user','$kodejadi','$nama','$nominal','$ket')");
    if ($result1) {
        mysqli_query($conn, "INSERT INTO riwayat_transaksi (id_user,id_transaksi,kategori,nominal,ket,acc) VALUES ('$id_user','$kodejadi','pengeluaran','$nominal','$ket','1')");
        return mysqli_query($conn, "INSERT INTO master (id_user,id_transaksi,nama,pengeluaran,ket) VALUES ('$id_user','$kodejadi','$nama','$nominal','$ket')");
    }
}

function adminHapus($id) {
    $conn = globalfun();
    
    if (is_array($id) && array_key_exists('id_user', $id)) {
        $id_transaksi = htmlspecialchars($id['id']);
        $id_user = htmlspecialchars($id['id_user']);

        // Gunakan parameterized queries
        $stmt_delete_pengeluaran = mysqli_prepare($conn, "DELETE FROM pengeluaran WHERE id_transaksi = ?");
        mysqli_stmt_bind_param($stmt_delete_pengeluaran, "s", $id_transaksi);
        $result_delete_pengeluaran = mysqli_stmt_execute($stmt_delete_pengeluaran);

        if ($result_delete_pengeluaran) {
            // Gunakan parameterized queries
            $stmt_insert_riwayat = mysqli_prepare($conn, "INSERT INTO riwayat_transaksi (id_user, id_transaksi, kategori, nominal, ket, acc) VALUES (?, ?, 'pengeluaran', '0', 'Hapus Data By Admin', '1')");
            mysqli_stmt_bind_param($stmt_insert_riwayat, "ss", $id_user, $id_transaksi);
            $result_insert_riwayat = mysqli_stmt_execute($stmt_insert_riwayat);

            if ($result_insert_riwayat) {
                // Gunakan parameterized queries
                $stmt_delete_master = mysqli_prepare($conn, "DELETE FROM master WHERE id_transaksi = ?");
                mysqli_stmt_bind_param($stmt_delete_master, "s", $id_transaksi);
                $result_delete_master = mysqli_stmt_execute($stmt_delete_master);

                // Periksa hasil query dan tangani kesalahan
                if ($result_delete_master) {
                    // Tutup statement
                    mysqli_stmt_close($stmt_delete_pengeluaran);
                    mysqli_stmt_close($stmt_insert_riwayat);
                    mysqli_stmt_close($stmt_delete_master);
                    mysqli_close($conn);

                    return true;
                } else {
                    return false;
                }
            } else {
                // Tangani kesalahan jika query riwayat_transaksi gagal
                // Tutup statement
                mysqli_stmt_close($stmt_insert_riwayat);
                return false;
            }
        } else {
            // Tangani kesalahan jika query pengeluaran gagal
            // Tutup statement
            mysqli_stmt_close($stmt_delete_pengeluaran);
            return false;
        }
    } else {
        return false;
    }
}



function adminEdit($data) {
    $conn       = globalfun();
    $id         = htmlspecialchars($data['id']);
    $id_user    = htmlspecialchars($data['id_user']);
    $nama       = htmlspecialchars($data['nama']);
    $nominal    = htmlspecialchars($data['nominal']);
    $ket        = htmlspecialchars($data['ket']);
    
    $result = mysqli_query($conn, "UPDATE pengeluaran SET nama = '$nama', nominal='$nominal', ket = '$ket'  WHERE id_transaksi = '$id'");
    if ($result) {
        mysqli_query($conn, "INSERT INTO riwayat_transaksi (id_user,id_transaksi,kategori,nominal,ket,acc) VALUES ('$id_user','$id','pemasukan','$nominal','Edit Data - $ket','1')");
        return mysqli_query($conn, "UPDATE master SET nama = '$nama', pengeluaran='$nominal', ket = '$ket'  WHERE id_transaksi = '$id'");
    }
}


// NASABAH
function nasabahPengeluaran($data) {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as SALDO FROM pengeluaran WHERE id_user='$data'"));  
}

function nasabahData($data) {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM pengeluaran WHERE id_user='$data'"));
}

function nasabahPemasukan($data) {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as SALDO FROM pemasukan WHERE id_user='$data'"));  
}

function countSaldo($data) {
    $conn       = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT (SUM(pemasukan))-(SUM(pengeluaran)) as SALDO FROM master WHERE id_user='$data'"));
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

    $result1 = mysqli_query($conn, "INSERT INTO pengeluaran (id_user,id_transaksi,nama,nominal,ket) VALUES ('$id_user','$kodejadi','$nama','$nominal','$ket')");
    if ($result1) {
        mysqli_query($conn, "INSERT INTO riwayat_transaksi (id_user,id_transaksi,kategori,nominal,ket,acc) VALUES ('$id_user','$kodejadi','pengeluaran','$nominal','$ket','1')");
        return mysqli_query($conn, "INSERT INTO master (id_user,id_transaksi,nama,pengeluaran,ket) VALUES ('$id_user','$kodejadi','$nama','$nominal','$ket')");
    }
}

function nasabahTenor() {
    $conn       = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT (SUM(pemasukan))-(SUM(pengeluaran)) as SALDO FROM master"));
}

?>  