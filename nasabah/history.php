<?php
session_start();
$judul = 'History Transaksi';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['nasabah'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'/../Controller/RiwayatController.php');

// var_dum;p(adminSaldo()->SALDO);
?>
<div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title"><?= $judul?></h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?= base_url('nasabah/index.php')?>">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('nasabah/history.php')?>"><?= $judul?></a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Total Transaksi : <?= rupiah(saldoNasabah($_SESSION['nasabah']->id_user)->SALDO) ?></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>ID Transaksi</th>
													<th>Kategori Transaksi</th>
													<th>Nominal</th>
													<th>Keterangan</th>
													<th>Waktu</th>
													<th>Status</th>
												</tr>
											</thead>
                                            <?php $no =1;?>
											<tbody>
                                                <?php $conn = globalfun();
												$id = $_SESSION['nasabah'];
												foreach (mysqli_fetch_all(mysqli_query($conn,
												"SELECT * FROM riwayat_transaksi WHERE id_user='$id->id_user'")) as $data) { ?>
                                                <tr>
                                                    <!-- <?php var_dump($data)?> -->
													<td><?= $no++?></td>
													<td><?= $data[2] ?></td>
													<td><?= ($data[3] == 'pemasukan')? 'Tabungan Masuk':'Tabungan Keluar'?></td>
													<td><?= rupiah($data[4])?></td>
													<td><?= $data[5];?></td>
													<td><?= $data[7];?></td>
													<td>
														<?php if ($data[6] == '0') { ?>
														<span class="badge badge-pill badge-warning">Pending</span>
														<?php } elseif ($data[6] == '3') { ?>
															<span class="badge badge-pill badge-danger">Reject</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-pill badge-success">Accept</span>
                                                        <?php } ?>
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

<?php include(__DIR__.'/../template/footer.php'); ?>