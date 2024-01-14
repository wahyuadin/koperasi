<?php 
$judul = "Halaman Master Laporan";
session_start();
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['nasabah'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');


include(__DIR__.'/../Controller/MasterController.php');
include(__DIR__.'/../Controller/DashboardController.php');
?>	

<div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Laporan</h4>
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
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Total Saldo :<?= rupiah(nasabahSaldo($_SESSION['nasabah']->id_user)->SALDO)?></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Nasabah</th>
													<th>Pengeluaran</th>
													<th>Pemasukan</th>
													<th>Total</th>
													<th>Keterangan</th>
													<th>Waktu</th>
													<th>Action</th>
												</tr>
											</thead>
                                            <?php $no =1;?>
											<tbody>
                                                <?php foreach (nasabahData($_SESSION['nasabah']->id_user) as $data) { ?>
                                                <tr>
                                                    <!-- <?php var_dump($data)?> -->
													<td><?= $no++?></td>
													<td><?= $data[3]?></td>
													<td><?= rupiah($data[4])?></td>
													<td><?= rupiah($data[5])?></td>
													<td><?= rupiah($data[4] + $data[5]);?></td>
													<td><?= $data[6];?></td>
													<td><?= $data[7];?></td>
													<td>
                                                        <a href="<?= base_url('nasabah/detail-master.php?detail=').$data['2']?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Detail</a>
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

<?php include(__DIR__.'/../template/footer.php')?>
