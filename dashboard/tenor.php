<?php
session_start();
$judul = 'Data Tenor';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['users'])) {
    return header('location:'. base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'./../Controller/TenorController.php');

if (isset($_POST['tambah'])) {
    if (adminInsert($_POST)) {
        set_flash_data('berhasil', 'Data Berhasil Disimpan!');
    }
}

if (isset($_POST['hapus'])) {
    if (adminHapus($_POST)) {
        set_flash_data('berhasil', 'Data Berhasil Dihapus!');
    }
}

if (isset($_POST['edit'])) {
    if (adminEdit($_POST)) {
        set_flash_data('berhasil', 'Data Berhasil Diedit!');
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
							<li class="nav-item">
								<a href="<?= base_url('dashboard/tenor.php')?>"><?= $judul?></a>
							</li>
              
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
                                    <button class="btn btn-secondary btn-border btn-sm mb-3" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-circle" style="margin-right: 8px;"></i>Tambah Data</button>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Bulan</th>
													<th>Persen %</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                          <?php $no = 1; foreach (adminData() as $data) { ?>
							<tr>
								<td><?= $no++?></td>
								<td><?= $data[1]?> Bulan</td>
								<td><?= $data[2]?> Persen %</td>
								<td>
									<a style="color: white;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?= $data[0]?>"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Edit</a>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?=$data[0]?>"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Hapus</button>
								  </td>
							</tr>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapus<?=$data[0]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <input type="text" name="id" value="<?= $data['0']?>" readonly hidden>
                              <div class="modal-body">
                                Apakah anda yakin menghapus data ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="" method="POST">
                                  <input type="text" name="id" value="<?=$data['0']?>" readonly hidden>
                                  <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Edit Data -->
                        <div class="modal fade" id="edit<?= $data[0]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="formGroupExampleInput2">Bulan</label>
                                        <input type="text" class="form-control" name="bulan" value="<?= $data['1']?>" id="formGroupExampleInput2" placeholder="Nama Nasabah" required>
                                        <input type="text" class="form-control" name="id" value="<?= $data['0']?>" id="formGroupExampleInput2" required readonly hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Persen %</label>
                                        <input type="number" class="form-control" name="persen" value="<?= $data['2']?>" id="formGroupExampleInput2" placeholder="Persen %" required>
                                    </div>
                                    
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                              </div>
                              </form>
							  <?php }?>
                            </div>
                          </div>
                        </div>
                        <!-- end modal -->
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
                <label for="formGroupExampleInput2">Bulan</label>
                <input type="number" class="form-control" name="bulan" id="formGroupExampleInput2" placeholder="Contoh : 1 = 1 Bulan" required>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Persen %</label>
                <input type="number" class="form-control" name="persen" id="formGroupExampleInput2" placeholder="Contoh : 1 = Bunga 1%" required>
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