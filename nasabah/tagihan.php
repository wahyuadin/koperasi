<?php
session_start();
$judul = 'Data Tagihan';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['nasabah'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'/../Controller/TagihanController.php');

if (isset($_POST['bayar'])) {
	if (bayarNasabah($_POST)) {
		set_flash_data('berhasil', 'Data Berhasil Disimpan!');
	}
}

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
                                    <h4 class="card-title">Total Transaksi : <?= rupiah(countAdmin()->SALDO) ?></h4>
								</div>
								<form action="" method="POST">
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
                                                $id_user = $_SESSION['nasabah']->id_user;
												foreach (mysqli_fetch_all(mysqli_query($conn,
												"SELECT transaksi.id_transaksi, tenor.bulan, tenor.persen, transaksi.nominal, transaksi.timestamp, transaksi.acc, transaksi.id_user, transaksi.id_user
                                                FROM transaksi
                                                INNER JOIN tenor ON tenor.id = transaksi.id_tenor WHERE id_user='$id_user'")) as $data) { ?>
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
														<?php } elseif ($data[5] == '3') { ?>
															<span class="badge badge-pill badge-danger">Reject</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-pill badge-success">Accept</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
														<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#bayar<?=$data[7]?>" name="bayar"><i class="fas fa-dollar-sign" style="margin-right: 8px;"></i>Bayar</button>
													</td>
												</tr>

												<!-- Modal Accept -->
												<div class="modal fade" id="bayar<?= $data[7]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLongTitle"><?= $judul?></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<p>Apakah Yakin Untuk Memilih data ?</p>
													</div>
													<div class="modal-footer">
														<form action="" method="POST">
															<input type="text" name="id_transaksi" value="<?=$data[7]?>" hidden readonly>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
														</form>
													</div>
													</div>
												</div>
												</div>
												<!-- end modal -->
                                                <?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								</form>
							</div>
						</div>
				</div>
			</div>
		</div>

<?php include(__DIR__.'/../template/footer.php'); ?>