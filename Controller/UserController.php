<?php 
function globalfun() {
    include(__DIR__.'/../koneksi.php');
    return $conn;
}

function adminCount() {
    $conn = globalfun();
    return mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
}


function adminAcc($data) {
    $conn       = globalfun();
    $id         = htmlspecialchars($data['id']);
    
    $result = mysqli_query($conn, "UPDATE users SET acc = '1'  WHERE id_user = '$id'");
    if ($result) {
        return $result;
    }
}

function adminHapus($data) {
    $conn       = globalfun();
    $id         = htmlspecialchars($data['id']);

    $result = mysqli_query($conn, "DELETE FROM users WHERE id_user = '$id'");
    if ($result) {
        return mysqli_query($conn, "DELETE FROM users_verif WHERE id_user = '$id'");
    }
}

function adminEdit($id) {
    $conn           = globalfun();
    $id             = htmlspecialchars($_POST['id']);
    $username       = htmlspecialchars($_POST['username']);
    $email          = htmlspecialchars($_POST['email']);
    $role           = htmlspecialchars($_POST['role']);
    $password       = htmlspecialchars($_POST['password']);
    $pwd            = password_hash($password, PASSWORD_DEFAULT);
    if ($password) {
        return mysqli_query($conn, "UPDATE users SET username = '$username', email = '$email', password = '$pwd', role = '$role'  WHERE id_user = '$id'");
    } else {
        return mysqli_query($conn, "UPDATE users SET username = '$username', email = '$email', role = '$role'  WHERE id_user = '$id'");
    }
}


// NASABAH
function nasabahEdit($post, $files) {
    $conn           = globalfun();
    $id             = htmlspecialchars($post['id']);
    $username       = htmlspecialchars($post['username']);
    $nama           = htmlspecialchars($post['nama']);
    $email          = htmlspecialchars($post['email']);
    $gambar         = $files["foto"]["name"];
    $tmp_name       = $files["foto"]["tmp_name"];
    $size           = $files["foto"]["size"];
    $password       = htmlspecialchars($post['password']);
    $pwd            = password_hash($password, PASSWORD_DEFAULT);

    $targetDir = "../assets/gambar/";
    $targetFile = $targetDir . basename($gambar);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($tmp_name);
    if ($check == false) {
        alert('Maaf, hanya file JPG dan PNG yang diizinkan.');
        $script = "<script>
        window.location = '".base_url('nasabah/user.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png") {
        alert('Maaf, hanya file JPG dan PNG yang diizinkan.');
        $script = "<script>
        window.location = '".base_url('nasabah/user.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        alert('Maaf, File sudah ada.');
        $script = "<script>
        window.location = '".base_url('nasabah/user.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if ($size > 1000000) {
        alert('Maaf, ukuran file terlalu besar, MAX 1 MB.');
        $script = "<script>
        window.location = '".base_url('nasabah/user.php')."';</script>";
        echo $script;
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($tmp_name, $targetFile)) {
            if ($password) {
                $query  = mysqli_query($conn, "UPDATE users SET nama = '$nama', username = '$username', email = '$email', password = '$pwd', foto = '$gambar'  WHERE id_user = '$id'");
                if ($query) {
                    mysqli_query($conn, "UPDATE users_verif SET nama = '$nama' WHERE id_user = '$id'");
                    $_SESSION['nasabah'] = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id'"));
                    return $query;
                }
            } else {
                $query  = mysqli_query($conn, "UPDATE users SET nama = '$nama', username = '$username', email = '$email', foto = '$gambar' WHERE id_user = '$id'");
                if ($query) {
                    mysqli_query($conn, "UPDATE users_verif SET nama = '$nama' WHERE id_user = '$id'");
                    $_SESSION['nasabah'] = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id'"));
                    return $query;
                }
            }
        } else {
              alert('Maaf, terjadi kesalahan saat mengunggah file.');
              $script = "<script>
              window.location = '".base_url('nasabah/user.php')."';</script>";
              echo $script;
              $uploadOk = 0;
        }
      } else {
          alert('Maaf, terjadi kesalahan saat mengunggah file.');
          $script = "<script>
          window.location = '".base_url('nasabah/user.php')."';</script>";
          echo $script;
      }
}

function countTagihan($id) {
    $conn = globalfun();
    return mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transaksi WHERE id_user='$id'"));
}

function angkaFormat($angka) {
    if ($angka >= 1000000000) {
        return number_format($angka / 1000000000, 1) . ' B';
    } elseif ($angka >= 1000) {
        return number_format($angka / 1000) . ' K';
    } else {
        return $angka;
    }
}

function pemasukan($data) {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as saldo FROM pemasukan WHERE id_user='$data'"));
    
}

function pengeluaran($data) {
    $conn   = globalfun();
    return mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as saldo FROM pengeluaran WHERE id_user='$data'"));  
}

?>