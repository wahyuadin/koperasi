<?php
session_start();
$judul = 'Detail Master Data';
$get = $_GET['detail'];
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['users'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'./../Controller/MasterController.php');

?>
<div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title"><?= $judul?></h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?= base_url('dashboard/index.php')?>">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('dashboard/master-laporan.php')?>">Master Laporan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a>Edit Master Laporan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Form Data</div>
									<div class="card-category">Aplikasi Koperasi Digital</div>
								</div>
								<form id="exampleValidation">
									<div class="card-body">
										<div class="form-group form-show-validation row">
											<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Id Transaksi <span class="required-label">*</span></label>
											<div class="col-lg-4 col-md-9 col-sm-8">
												<input type="text" class="form-control" id="name" name="name" value="<?= adminDetail($get)->id_transaksi?>" disabled placeholder="Enter Username" required>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group form-show-validation row">
											<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nama <span class="required-label">*</span></label>
											<div class="col-lg-4 col-md-9 col-sm-8">
												<input type="text" class="form-control" id="name" name="name" value="<?= adminDetail($get)->nama?>" disabled placeholder="Enter Username" required>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group form-show-validation row">
											<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Pengeluaran <span class="required-label">*</span></label>
											<div class="col-lg-4 col-md-9 col-sm-8">
												<input type="text" class="form-control" id="name" name="name" value="<?= rupiah(adminDetail($get)->pengeluaran)?>" disabled placeholder="Enter Username" required>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group form-show-validation row">
											<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Pemasukan <span class="required-label">*</span></label>
											<div class="col-lg-4 col-md-9 col-sm-8">
												<input type="text" class="form-control" id="name" name="name" value="<?= rupiah(adminDetail($get)->pemasukan)?>" disabled placeholder="Enter Username" required>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group form-show-validation row">
											<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Keterangan <span class="required-label">*</span></label>
											<div class="col-lg-4 col-md-9 col-sm-8">
												<input type="text" class="form-control" id="name" name="name" value="<?= adminDetail($get)->ket?>" disabled placeholder="Enter Username" required>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group form-show-validation row">
											<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Waktu Transaksi <span class="required-label">*</span></label>
											<div class="col-lg-4 col-md-9 col-sm-8">
												<input type="text" class="form-control" id="name" name="name" value="<?= adminDetail($get)->timestamp?>" disabled placeholder="Enter Username" required>
											</div>
										</div>
									</div>
									<div class="card-action">
										<div class="row">
											<div class="col-md-12">
												<!-- <input class="btn btn-success" type="submit" value="Validate"> -->
												<a href="<?= base_url('dashboard/master-laporan.php')?>" style="color: white;" class="btn btn-danger">Cancel</a>
											</div>										
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
			</div>
			
		</div>

<?php include(__DIR__.'/../template/footer.php'); ?>