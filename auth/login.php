<?php 
session_start();
include(__DIR__.'/../Controller/LoginController.php');

if (isset($_SESSION['users'])) {
    header('location:'.base_url('dashboard/index.php'));
}

if (isset($_SESSION['nasabah'])) {
    header('location:'.base_url('nasabah/index.php'));
}
if (isset($_POST['login'])) {
	$username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
	return login($username, $password);
}


if(isset($_POST['register'])) {
    $data = [
        'nama'        => htmlspecialchars($_POST['nama']),
        'email'       => htmlspecialchars($_POST['email']),
        'username'    => htmlspecialchars($_POST['username']),
        'password'    => htmlspecialchars($_POST['password']),
        'repassword'  => htmlspecialchars($_POST['repassword']),
    ];
   return register($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url('assets/img/icon.ico')?>" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?= base_url('assets/js/plugin/webfont/webfont.min.js')?>"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url('assets/css/fonts.min.css')?>']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/atlantis.css')?>">
</head>
<body class="login">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
			<h1 class="title fw-bold text-white mb-3">Aplikasi Koperasi Digital</h1>
			<p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>
		</div>
		<div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
			<div class="container container-login container-transparent animated fadeIn">
				<h3 class="text-center">Halaman Login</h3>
                <?php
                $gagal = get_flash_data('gagal');
                if ($gagal) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $gagal;?>
                </div>
                <?php } ?>
                <?php
                $gagal = get_flash_data('berhasil');
                if ($gagal) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $gagal;?>
                </div>
                <?php } ?>
				<form action="" method="POST">
				<div class="login-form">
					<div class="form-group">
						<label for="username" class="placeholder"><b>Username</b></label>
						<input id="username" name="username" type="text" class="form-control" placeholder="Masukan Username" required>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<a href="<?=base_url('auth/forget-password.php')?>" class="link float-right">Lupa Password ?</a>
						<div class="position-relative">
							<input id="password" name="password" type="password" placeholder="Masukan Password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group form-action-d-flex mb-3">
						<button type="submit" name="login" class="btn btn-secondary col-md-5 mt-3 mt-sm-0 fw-bold">Sign In</button>
					</div>
					</form>
					<div class="login-account">
						<span class="msg">Belum punya akun ?</span>
						<a href="#" id="show-signup" class="link">Daftar</a>
					</div>
				</div>
			</div>

			<div class="container container-signup container-transparent animated fadeIn">
				<h3 class="text-center">Halaman Register</h3>
                <form action="" method="POST">
				<div class="login-form">
					<div class="form-group">
						<label for="fullname" class="placeholder"><b>Nama Lengkap</b></label>
						<input  id="fullname" name="nama" type="text" class="form-control" placeholder="Masukan Nama Lengkap" required>
					</div>
					<div class="form-group">
						<label for="email" class="placeholder"><b>Email</b></label>
						<input  id="email" name="email" type="email" class="form-control" placeholder="Masukan Alamat Email" required>
					</div>
					<div class="form-group">
						<label for="email" class="placeholder"><b>Username</b></label>
						<input name="username" type="text" class="form-control" placeholder="Masukan Username" required>
					</div>
					<div class="form-group">
						<label for="passwordsignin" class="placeholder"><b>Password</b></label>
						<div class="position-relative">
							<input  id="passwordsignin" name="password" type="password" class="form-control" placeholder="Masukan Password" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="confirmpassword" class="placeholder"><b>Confirm Password</b></label>
						<div class="position-relative">
							<input  id="confirmpassword" name="repassword" type="password" class="form-control" placeholder="Ulangi Password" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="row form-action">
						<div class="col-md-6">
							<a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
						</div>
						<div class="col-md-6">
							<button type="submit" name="register" class="btn btn-secondary w-100 fw-bold">Register</button>
						</div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/js/core/jquery.3.2.1.min.js')?>"></script>
	<script src="<?= base_url('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')?>"></script>
	<script src="<?= base_url('assets/js/core/popper.min.js')?>"></script>
	<script src="<?= base_url('assets/js/core/bootstrap.min.js')?>"></script>
	<script src="<?= base_url('assets/js/atlantis.min.js')?>"></script>
</body>
</html>