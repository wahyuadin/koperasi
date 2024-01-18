<?php
session_start();
$judul = 'Data User';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['users'])) {
    return header('location:'. base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'/../Controller/UserController.php');

if (isset($_POST['acc'])) {
  if (adminAcc($_POST)) {
    set_flash_data('berhasil', 'Data Berhasil Di Acc!');
  }
}

if (isset($_POST['hapus'])) {
  if (adminHapus($_POST)) {
    set_flash_data('berhasil', 'Data Berhasil Di Hapus!');
  }
}

if (isset($_POST['edit'])) {
  if (adminEdit($_POST)) {
     set_flash_data('berhasil', 'Data Berhasil Di Edit!');
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
							<li class="separator">4   
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('dashboard/user.php')?>"><?= $judul?></a>
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
                  <h4 class="card-title">Total Pendaftar : <?php $conn = globalfun(); echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"))?> User</h4>
								</div>
								<div class="card-body">
                    <!-- <button class="btn btn-secondary btn-border btn-sm mb-3" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-circle" style="margin-right: 8px;"></i>Tambah Data</button> -->
								<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Email</th>
													<th>Username</th>
													<th>Role</th>
													<th>Acc</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                          <?php $no=1; $conn = globalfun(); foreach (mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM  users")) as $data) { ?>
                          <tr>
													<td><?= $no++?></td>
													<td><?= $data[2]?></td>
													<td><?= $data[3]?></td>
													<td><?= $data[4];?></td>
													<td><?php echo ($data[7]) == '1' ? "Admin":"Nasabah" ?></td>
													<td><?php echo ($data[8]) == '1' ? "Acc":"Belum Acc" ?></td>
													<td>
                              <a style="color: white;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?=$data['1']?>"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Edit</a>
                              <button type="button" href="<?= base_url('dashboard/hapus-pemasukan.php?detail=').$data['2']?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?=$data['1']?>"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Hapus</button>
                              <?php if ($data[8] == '0') { ?>
                                <button type="button" href="<?= base_url('dashboard/hapus-pemasukan.php?detail=').$data['2']?>" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#acc<?=$data['1']?>"><i class="fas fa-user-check" style="margin-right: 10px;"></i>Acc</button>
                              <?php } ?>
                          </td>
												</tr>

                        <!-- Modal Acc -->
                        <div class="modal fade" id="acc<?=$data['1']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ACC Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <input type="text" name="id" value="<?= $data['2']?>" readonly hidden>
                              <div class="modal-body">
                                Apakah anda yakin Acc data ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="" method="POST">
                                  <input type="text" name="id" value="<?=$data['1']?>" readonly hidden>
                                  <button type="submit" name="acc" class="btn btn-primary">Ganti</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapus<?=$data['1']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <input type="text" name="id" value="<?= $data['2']?>" readonly hidden>
                              <div class="modal-body">
                                Apakah anda yakin menghapus data ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="" method="POST">
                                  <input type="text" name="id" value="<?=$data['1']?>" readonly hidden>
                                  <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Edit Data -->
                        <div class="modal fade" id="edit<?=$data['1']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit <?= $judul?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Nama</label>
                                        <input type="text" class="form-control" name="id" value="<?= $data['1']?>" id="formGroupExampleInput2" placeholder="Nama Nasabah" required readonly hidden>
                                        <input type="text" class="form-control" name="nama" value="<?= $data['2']?>" id="formGroupExampleInput2" placeholder="Nama Nasabah" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Email</label>
                                        <input type="text" class="form-control" name="email" value="<?= $data['3']?>" id="formGroupExampleInput2" placeholder="Nominal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Keterangan" value="<?= $data['4']?>" requireq>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Role</label>
                                        <select class="form-control" name="role" aria-label="Default select example">
                                            <option disabled>Pilih Salah Satu..</option>
                                            <option <?php echo ($data['7'] == '0') ? 'selected':'' ?> value="0">Nasabah</option>
                                            <option <?php echo ($data['7'] == '1') ? 'selected':'' ?> value="1">Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Ganti Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" requireq>
                                        <p style="color: red; margin-left:10px;">* Jika password tidak rubah, lewati proses ini.</p>
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end modal -->

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


<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
            <div class="form-group">
                <label for="formGroupExampleInput2">Nama Nasabah</label>
                <input type="text" class="form-control" name="nama" id="formGroupExampleInput2" placeholder="Nama Nasabah" required>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Nominal</label>
                <input type="number" class="form-control" name="nominal" id="formGroupExampleInput2" placeholder="Nominal" required>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Keterangan</label>
                <textarea name="ket" class="form-control" cols="30" rows="4" placeholder="Keterangan" required></textarea>
                <!-- <input type="text" class="form-control" name="ket" placeholder="Keterangan" requireq> -->
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="tambah" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->




<?php include(__DIR__.'/../template/footer.php'); ?>