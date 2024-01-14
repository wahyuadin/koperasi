<?php
include(__DIR__.'/../template/config.php');

function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function index($data) {
    $conn = globalfun();
    $obj = (object)$data;
    $sql = "INSERT INTO users_verif (id_user,nama,alamat,prov,kab,kec,kel,rt_rw,file_upload) VALUES
        ('$obj->id', '$obj->nama','$obj->alamat', '$obj->provinsi','$obj->kabupaten','$obj->kecamatan','$obj->kelurahan','$obj->rt','$obj->ktp')";
    if ($conn->query($sql)) {
        $update = "UPDATE users SET val='1', nama='$obj->nama' WHERE id_user='$obj->id'";
        if ($conn->query($update)) {
            alert('Pengajuan Berhasil, silahkan hubungi admin untuk melanjutkan');
            $script = "<script>
            window.location = '".base_url()."';</script>";
            echo $script;
        }
        
    }

}
?>