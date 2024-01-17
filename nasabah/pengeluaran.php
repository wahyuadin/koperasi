<?php
session_start();
$judul = 'Laporan Pengeluaran';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['nasabah'])) {
    return header('location:'. base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');

include(__DIR__.'./../Controller/PengeluaranController.php');


if (isset($_POST['tambah'])) {
  var_dump($_POST['pinjaman']); die;
    if (htmlspecialchars($_POST['nominal']) <= countSaldo($_SESSION['nasabah']->id_user)->SALDO) {
      if (nasabahInsert($_POST)) {
        set_flash_data('berhasil', 'Data Berhasil Disimpan!');
      }
    } elseif (htmlspecialchars($_POST['pinjaman']) <= number_format(nasabahTenor()->SALDO * 10 / 100,0,'.','')) {
      if (nasabahInsert($_POST)) {
        set_flash_data('berhasil', 'Data Berhasil Disimpan!');
      }
    } else {
      set_flash_data('gagal', 'Saldo Tidak Cukup!');
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
								<a href="<?= base_url('dashboard/pengeluaran.php')?>"><?= $judul?></a>
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
                  <h4 class="card-title">Total pengeluaran : <?= rupiah(nasabahPengeluaran($_SESSION['nasabah']->id_user)->SALDO) ?></h4>
								</div>
								<div class="card-body">
                    <button class="btn btn-secondary btn-border btn-sm mb-3" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-circle" style="margin-right: 8px;"></i>Tambah Data</button>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Nasabah</th>
													<th>Nominal</th>
													<th>Keterangan</th>
													<th>Waktu</th>
													<!-- <th>Action</th> -->
												</tr>
											</thead>
											<tbody>
                          <?php $no=1; foreach (nasabahData($_SESSION['nasabah']->id_user) as $data) { ?>
                          <tr>
													<td><?= $no++?></td>
													<td><?= $data[3]?></td>
													<td><?= rupiah($data[5])?></td>
													<td><?= $data[6];?></td>
													<td><?= $data[7];?></td>
													<td>
                              <!-- <a style="color: white;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?=$data['2']?>"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Edit</a>
                              <button type="button" href="<?= base_url('dashboard/hapus-pengeluaran.php?detail=').$data['2']?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?=$data['2']?>"><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Hapus</button> -->
                          </td>
												</tr>
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapus<?=$data['2']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" name="id" value="<?=$data['2']?>" readonly hidden>
                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <!-- Modal Edit Data -->
                        <div class="modal fade" id="edit<?=$data['2']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="formGroupExampleInput2">Nama Nasabah</label>
                                        <input type="text" class="form-control" name="nama" value="<?= $data['3']?>" id="formGroupExampleInput2" placeholder="Nama Nasabah" required readonly>
                                        <input type="text" class="form-control" name="id" value="<?= $data['1']?>" id="formGroupExampleInput2" placeholder="Nama Nasabah" required readonly hidden>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Keterangan</label>
                                        <textarea name="ket" class="form-control" cols="30" rows="4" placeholder="Keterangan" required><?= $data['6']?></textarea>
                                        <!-- <input type="text" class="form-control" name="ket" placeholder="Keterangan" requireq> -->
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
        <div id="errorAlert" class="alert alert-danger" role="alert" style="display: none;"></div>
        <form method="POST" action="">
          <div class="form-group">
            <label for="formGroupExampleInput2">Nama Nasabah</label>
            <input type="text" name="nama" class="form-control" aria-label="Default select example" required placeholder="Nama Nasabah" value="<?php echo $_SESSION['nasabah']->nama?>" readonly>
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Kategori</label>
            <select class="form-control" name="kategori" id="kategoriSelect" onchange="showFields()">
              <option selected disabled>Pilih Salah Satu...</option>
              <option value="tabungan">Tabungan</option>
              <option value="pinjaman">Pinjaman</option>
            </select>
          </div>
          <!-- tabungan -->
          <div class="form-group" id="nominalKeteranganFields" style="display: none;">
            <label for="formGroupExampleInput2">Nominal</label>
            <input type="number" class="form-control" name="nominal" id="nominal" placeholder="Jumlah Tabungan Anda : <?= rupiah(countSaldo($_SESSION['nasabah']->id_user)->SALDO)?>" oninput="validateNominal()">
          </div>
          <div class="form-group" id="keterangan" style="display: none;">
            <label>Keterangan</label>
            <textarea name="ket" class="form-control" cols="30" rows="4" placeholder="Keterangan"></textarea>
          </div>
          <!-- end tabungan -->
          <!-- pinjaman -->
          <div class="form-group" id="pinjamanNominal" style="display: none;">
            <label>Nominal</label>
            <?php $limit = nasabahTenor()->SALDO * 10 / 100; ?>
            <input type="number" class="form-control" name="pinjaman" id="pinjaman" placeholder="Limit Peminjaman Anda : <?= rupiah($limit)?>" oninput="validateNominal2()">
          </div>
          <div class="form-group" id="tenorFields" style="display: none;">
            <label for="tenor">Tenor</label>
            <select name="tenor" class="form-control" id="tenor" onchange="">
              <option selected disabled>Pilih salah satu...</option>
              <option value="1">1 Bulan - Bunga 5% </option>
              <option value="3">3 Bulan - Bunga 10%</option>
              <option value="6">6 Bulan - Bunga 15%</option>
              <option value="12">12 Bulan - Bunga 20%</option>
            </select>
          </div>
          <!-- end pinjaman -->
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