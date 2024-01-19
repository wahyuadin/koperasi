<?php
function adminGetData() {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM users_verif'));
}

function nasabahGetData($data) {
    $conn = globalfun();
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM users_verif WHERE id_user='$data'"));
    
}


function provinsi($id) {
    $api_url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";
    $response = file_get_contents($api_url);
    $provinsi = json_decode($response, true);

    foreach ($provinsi as $item) {
        if ($item['id'] === $id) {
            return $item['name'];
        }
    }
    return null;
}

function kabupaten($prov, $id) {
    $api_url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/".$prov.".json";
    $response = file_get_contents($api_url);
    $kab = json_decode($response, true);
    
    foreach ($kab as $item) {
        if ($item['id'] === $id) {
            return $item['name'];
        }
    }
    return null;
}

function kecamatan($kab, $id) {
    $api_url = "https://www.emsifa.com/api-wilayah-indonesia/api/districts/".$kab.".json";
    $response = file_get_contents($api_url);
    $kab = json_decode($response, true);
    
    foreach ($kab as $item) {
        if ($item['id'] === $id) {
            return $item['name'];
        }
    }
    return null;

}


function kelurahan($kec, $id) {
    $api_url = "https://www.emsifa.com/api-wilayah-indonesia/api/villages/".$kec.".json";
    $response = file_get_contents($api_url);
    $kab = json_decode($response, true);
    
    foreach ($kab as $item) {
        if ($item['id'] === $id) {
            return $item['name'];
        }
    }
    return null;

}


?>