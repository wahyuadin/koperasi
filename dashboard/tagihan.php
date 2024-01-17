<?php
session_start();
$judul = 'Data Tagihan';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['users'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'/../Controller/TagihanController.php');

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
                                    <h4 class="card-title">Total Transaksi : <?= rupiah(countAdmin()->SALDO) ?></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Nasabah</th>
													<th>Tenor</th>
													<th>Bunga</th>
													<th>Nominal</th>
													<th>Waktu</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
                                            <?php $no =1;?>
											<tbody>
                                                <?php $conn = globalfun();
												foreach (mysqli_fetch_all(mysqli_query($conn,
												"SELECT transaksi.id_transaksi, tenor.bulan, tenor.persen, transaksi.nominal, transaksi.timestamp, transaksi.acc, transaksi.id_user
                                                FROM transaksi
                                                INNER JOIN tenor ON tenor.id = transaksi.id_tenor")) as $data) { ?>
                                                <tr>
													<td><?= $no++?></td>
													<td><?= mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM users WHERE id_user='$data[6]'"))->nama?> </td>
													<td><?= $data[1]." Bulan" ?></td>
													<td><?= $data[2]. " Persen %" ?></td>
													<td><?= rupiah($data[3])?></td>
													<td><?= $data[4];?></td>
													<td>
														<?php if ($data[5] == '0') { ?>
														<span class="badge badge-pill badge-warning">Pending</span>
														<?php } elseif ($data[6] == '3') { ?>
															<span class="badge badge-pill badge-danger">Reject</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-pill badge-success">Accept</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>acc</td>
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