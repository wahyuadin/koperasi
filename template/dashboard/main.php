<?php 
$judul = "Halaman Dashboard";
include(__DIR__.'/../header.php');
include(__DIR__.'/../sitebar.php');
include(__DIR__.'/../navbar_header.php');
include(__DIR__.'/../../Controller/MasterController.php');
include(__DIR__.'/../../Controller/DashboardController.php');
?>	

<div class="container">
				<div class="page-inner">
					<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-3 pb-4">
						<div>
							<h2 class="pb-2 fw-bold">Dashboard</h2>
							<h5 class="op-7 mb-2">Aplikasi Koperasi Simpan Pinjam</h5>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-analytics text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Saldo</p>
												<h4 class="card-title"><?= rupiah(adminSaldo()->SALDO)?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-credit-card text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Uang Masuk</p>
												<h4 class="card-title"><?= rupiah(adminPemasukan()->SALDO)?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-coins text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Uang Keluar</p>
												<h4 class="card-title"><?= rupiah(adminPengeluaran()->SALDO)?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Data Nasabah</div>
										<div class="card-tools">
											<a href="#" class="btn btn-info btn-border btn-round btn-sm">
												<span class="btn-label">
													<i class="fa fa-print"></i>
												</span>
												Print
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
								<div class="table-responsive">
								<table id="tabel-data" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>Provinsi</th>
											<th>Kabupaten</th>
											<th>Kecamatan</th>
											<th>Kelurahan</th>
											<th>RT/RW</th>
											<th>KTP</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										// var_dump(adminGetData());
										foreach (adminGetData() as $data) { ?>
											<tr>
												<th scope="row"><?= $no++?></th>
												<td><?= $data[2]?></td>
												<td><?= $data[3]?></td>
												<td><?= provinsi($data[4])?></td>
												<td><?= kabupaten($data[4] , $data[5])?></td>
												<td><?= kecamatan($data[5], $data[6])?></td>
												<td><?= kelurahan($data[6], $data[7])?></td>
												<td><?= $data[8]?></td>
												<td>
													<a class="btn btn-primary btn-sm" href="<?=base_url('assets/gambar/'.$data[9])?>">Lihat Gambar</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
<?php include(__DIR__.'/../footer.php')?>