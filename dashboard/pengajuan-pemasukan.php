<?php
session_start();
$judul = 'Pengajuan Pemasukan';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['users'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'/../Controller/RiwayatController.php');

if (isset($_POST['acc'])) {
    if (acc($_POST)) {
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
								<a href="<?= base_url('dashboard/index.php')?>">
									<i class="flaticon-home"></i>
								</a>
							</li>
                            <li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
                            <li>
                                <a>Pemasukan Report</a>
                            </li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('dashboard/pengajuan-pemasukan.php')?>"><?= $judul?></a>
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
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Kategori Transaksi</th>
													<th>Nominal</th>
													<th>Keterangan</th>
													<th>Waktu</th>
													<th>Action</th>
												</tr>
											</thead>
                                            <?php $no =1;?>
											<tbody>
                                                <?php $conn = globalfun();
												foreach (mysqli_fetch_all(mysqli_query($conn,
												"SELECT riwayat_transaksi.id_transaksi, users.nama, riwayat_transaksi.kategori, riwayat_transaksi.nominal, riwayat_transaksi.ket, riwayat_transaksi.timestamp
                                                FROM users
                                                INNER JOIN riwayat_transaksi ON riwayat_transaksi.id_user = users.id_user
                                                WHERE riwayat_transaksi.acc = '0'")) as $data) { ?>
                                                <tr>
                                                    <!-- <?php var_dump($data)?> -->
													<td><?= $no++?></td>
													<td><?= $data[1] ?></td>
													<td><?= ($data[2] == 'pemasukan')? 'Tabungan Masuk':'Tabungan Keluar'?></td>
													<td><?= rupiah($data[3])?></td>
													<td><?= $data[4];?></td>
													<td><?= $data[5];?></td>
                                                    <td>
                                                        <!-- <a style="color: white;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?=$data['2']?>"><i class="fas fa-check-circle" style="margin-right: 10px;"></i>Accept</a> -->
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#acc<?= $data[0]?>"><i class="fas fa-check-circle" style="margin-right: 10px;"></i>Accept</button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?=$data['1']?>"><i class="fas fa-times-circle" style="margin-right: 10px;"></i>Reject</button>
                                                    </td>
												</tr>

                                                <!-- Modal Reject -->
                                                <div class="modal fade" id="hapus<?=$data['1']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?= $judul?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="id" value="<?= $data['2']?>" readonly hidden>
                                                    <div class="modal-body">
                                                        Apakah anda yakin mereject data ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="" method="POST">
                                                        <input type="text" name="id" value="<?=$data['2']?>" readonly hidden>
                                                        <input type="text" name="id_user" value="<?=$_SESSION['users']->id_user?>" readonly hidden>
                                                        <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <!-- Modal Acc -->
                                                <div class="modal fade" id="acc<?= $data[0]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?= $judul?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="id_user" value="<?= $data?>" readonly hidden>
                                                    <div class="modal-body">
                                                        Apakah anda yakin mengaprove data ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="" method="POST">
                                                        <input type="text" name="id_transaksi" value="<?=$data['0']?>" readonly hidden>
                                                        <button type="submit" name="acc" class="btn btn-success">Acc</button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

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