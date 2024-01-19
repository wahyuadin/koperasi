<?php
session_start();
$judul = 'User Profile';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['nasabah'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');


include(__DIR__.'/../Controller/UserController.php');
if (isset($_POST['simpan'])) {
    if (nasabahEdit($_POST, $_FILES)) {
        set_flash_data('berhasil', 'Data Berhasil Disimpan!');
    }
}
?>

			<div class="container">
				<div class="page-inner">
					<h4 class="page-title"><?= $judul?></h4>
					<div class="row">
						<div class="col-md-8">
							<div class="card card-with-nav">
                                <form action="" method="post" enctype="multipart/form-data">
								<div class="card-body">
                                <?php
                                $gagal = get_flash_data('gagal');
                                if ($gagal) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $gagal;?>
                                </div>
                                <?php } ?>
                                <?php
                                $berhasil = get_flash_data('berhasil');
                                if ($berhasil) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $berhasil;?>
                                </div>
                                <?php } ?>
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group form-group-default">
												<label>Nama</label>
                                                <input type="text" name="id" hidden value="<?= $_SESSION['nasabah']->id_user?>">
												<input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= $_SESSION['nasabah']->nama?>" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-group-default">
												<label>Email</label>
												<input type="text" class="form-control" value="<?= $_SESSION['nasabah']->email?>" name="email" placeholder="Alamat Email" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-group-default">
												<label>Username</label>
												<input type="text" class="form-control" value="<?= $_SESSION['nasabah']->username?>" name="username" placeholder="username" required>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="form-group form-group-default">
												<label>Password</label>
												<input type="text" class="form-control" name="password" placeholder="Jika password tidak di ganti, lewati form ini">
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="form-group form-group-default">
												<label>Foto</label>
                                                <input type="file" class="form-control" name="foto" accept=".png, .jpg" required>
                                                <p style="margin-left: 8px; color:red;">*Format gambar berupa JPG/PNG</p>
											</div>
										</div>
									</div>
									<div class="text-left mt-3 mb-3">
										<button type="submit" name="simpan" class="btn btn-primary btn-sm">Simpan</button>
									</div>
								</div>
                                </form>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('<?= base_url('assets/img/blogpost.jpg')?>')">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="<?= base_url('assets/gambar/'.$_SESSION['nasabah']->foto)?>" alt="..." class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name">Hallo ! <?= $_SESSION['nasabah']->nama?></div>
										<div class="job"><?= $_SESSION['nasabah']->username?></div>
										<div class="desc"><?= $_SESSION['nasabah']->email?></div>
									</div>
								</div>
								<div class="card-footer">
									<div class="row user-stats text-center">
										<div class="col">
											<div class="number"><?= countTagihan($_SESSION['nasabah']->id_user)?></div>
											<div class="title">Tagihan Aktif</div>
										</div>
										<div class="col">
											<div class="number"><?= angkaFormat(pemasukan($_SESSION['nasabah']->id_user)->saldo)?></div>
											<div class="title">Pemasukan</div>
										</div>
										<div class="col">
											<div class="number"><?= angkaFormat(pengeluaran($_SESSION['nasabah']->id_user)->saldo)?></div>
											<div class="title">Pengeluaran</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

        <?php include(__DIR__.'/../template/footer.php'); ?>