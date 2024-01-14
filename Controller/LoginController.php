<?php
include(__DIR__.'/../template/config.php');

    function globalfun() {
        include(__DIR__.'/../koneksi.php');
        return $conn;
    }
        
    function login($username, $password) {  
        $conn = globalfun();
        $query = "SELECT * FROM users WHERE username = '$username'";
        if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
            $objek = mysqli_fetch_object(mysqli_query($conn, $query));
                if (password_verify($password, $objek->password)) {
                    if ($objek->val > 0) {
                        if ($objek->acc == '0') {
                            alert('Pengajuan berhasil ! Silahkan hubungi admin.');
                            $script = "<script>
                            window.location = '".base_url()."';</script>";
                            echo $script;
                        } else {
                            if ($objek->role == '1') {
                                $_SESSION['users'] = $objek;
                                return header('location:'.base_url('dashboard/index.php'));
                            } else {
                                $_SESSION['nasabah'] = $objek;
                                return header('location:'.base_url('nasabah/index.php'));
                            }
                        }
                    }else {
                        
                        $_SESSION['verif'] = $objek;
                        return header('location:'.base_url('auth/verifikasi.php'));
                    }
                } else {
                    set_flash_data('gagal','Username Atau Password Salah!');
                    header('location:'.base_url('auth/login.php'));
                }
            } else {
                set_flash_data('gagal','Username Atau Password Salah!');
                header('location:'.base_url('auth/login.php'));
            }
    }

    function register($data) {
        $conn = globalfun();
        $query = mysqli_query($conn, "SELECT RIGHT(id_user, 3) as kode FROM users ORDER BY id_user DESC LIMIT 1");
        $result = $query->fetch_object();
        if ($result) {
            $kode = intval($result->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, rand(5, 998), STR_PAD_LEFT);
        $kodejadi = "LPN-" . $kodemax;
        $data = (object)$data;
        $result1 = "SELECT * FROM users WHERE username = '$data->username'";
        $result2 = "SELECT * FROM users WHERE email = '$data->email'";
        if (mysqli_num_rows(mysqli_query($conn, $result1)) > 0) {
            if (mysqli_num_rows(mysqli_query($conn, $result2)) > 0) {
                set_flash_data('gagal','Data sudah terdaftar!');
                header('location:'.base_url('auth/login.php'));
            }else {
                set_flash_data('gagal','Data sudah terdaftar!');
                header('location:'.base_url('auth/login.php'));
            }
        }else {
            if ($data->password == $data->repassword) {
                $hash = password_hash($data->repassword, PASSWORD_DEFAULT, ['cost' => 10]);
                $sql = "INSERT INTO users (id_user,nama,email,username,password) VALUES ('$kodejadi', '$data->nama', '$data->email', '$data->username','$hash')";
                if ($conn->query($sql)) {
                    set_flash_data('berhasil','Registrasi berhasil, silahkan login!');
                    header('location:'.base_url('auth/login.php'));
                }
            } else {
                set_flash_data('gagal','Password tidak sama, ulangi lagi!');
                header('location:'.base_url('auth/login.php'));
            }
        }
    }
?>