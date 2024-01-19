<?php
include(__DIR__.'/../template/config.php');

function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function index($data) {
    $conn = globalfun();
    $obj = (object)$data;

    $targetDir = "../assets/gambar/";
    $targetFile = $targetDir . basename($obj->ktp);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($obj->tmp_name);
    if ($check == false) {
        alert('Maaf, hanya file JPG dan PNG yang diizinkan.');
        $script = "<script>
        window.location = '".base_url('auth/verifikasi.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png") {
        alert('Maaf, hanya file JPG dan PNG yang diizinkan.');
        $script = "<script>
        window.location = '".base_url('auth/verifikasi.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        alert('Maaf, File sudah ada.');
        $script = "<script>
        window.location = '".base_url('auth/verifikasi.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if ($obj->size > 1000000) {
        alert('Maaf, ukuran file terlalu besar, MAX 1 MB.');
        $script = "<script>
        window.location = '".base_url('auth/verifikasi.php')."';</script>";
        echo $script;
        $uploadOk = 0;
      $uploadOk = 0;
    }

    if ($uploadOk == 1) {
      if (move_uploaded_file($obj->tmp_name, $targetFile)) {
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
      } else {
            alert('Maaf, terjadi kesalahan saat mengunggah file.');
            $script = "<script>
            window.location = '".base_url('auth/verifikasi.php')."';</script>";
            echo $script;
            $uploadOk = 0;
      }
    } else {
        alert('Maaf, terjadi kesalahan saat mengunggah file.');
        $script = "<script>
        window.location = '".base_url('auth/verifikasi.php')."';</script>";
        echo $script;
    }

}
?>