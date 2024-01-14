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

?>