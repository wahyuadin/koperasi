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

if (isset($_POST['submitTabungan'])) {
  $saldo = countSaldo($_SESSION['nasabah']->id_user)->SALDO;
  if (htmlspecialchars($_POST['nominal'] <= $saldo)) { 
      if (nasabahInsert($_POST)) {
          set_flash_data('berhasil', 'Data Berhasil Disimpan!');
      }
  } else {
    set_flash_data('gagal', 'Nominal Melebihi Batas Saldo!');
  }
}

if (isset($_POST['submitPinjaman'])) {
  if (htmlspecialchars($_POST['pinjaman']) <= nasabahTenor()->SALDO * 10 / 100) {
    if (submitSimpan($_POST)) {
        alert('Pengajuan berhasil ! tunggu admin hingga menyetujui');
        $script = "<script>
        window.location = '".base_url('nasabah/history.php')."';</script>";
        echo $script;
    }
  } else {
    set_flash_data('gagal', 'Nominal Melebihi Batas Saldo!');
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
          <form action="" method="POST">
          <div class="form-group" id="nominalKeteranganFields" style="display: none;">
            <label for="formGroupExampleInput2">Nominal</label>
            <input type="text" name="nama" class="form-control" aria-label="Default select example" required placeholder="Nama Nasabah" value="<?php echo $_SESSION['nasabah']->nama?>" readonly hidden>
            <input type="number" class="form-control" name="nominal" id="nominal" placeholder="Jumlah Tabungan Anda : <?= rupiah(countSaldo($_SESSION['nasabah']->id_user)->SALDO)?>" oninput="validateNominal()" required>
          </div>
          <div class="form-group" id="keterangan" style="display: none;">
            <label>Keterangan</label>
            <input type="text" name="nama" class="form-control" aria-label="Default select example" required placeholder="Nama Nasabah" value="<?php echo $_SESSION['nasabah']->nama?>" readonly hidden>
            <textarea name="ket" class="form-control" cols="30" rows="4" placeholder="Keterangan" required></textarea>
          </div>
          <div class="modal-footer" id="nominalFooter" style="display: none;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submitTabungan" class="btn btn-primary">Save changes</button>
          </div>
          </form>
          <!-- end tabungan -->
          <!-- pinjaman -->
          <form action="" method="POST">
          <div class="form-group" id="pinjamanNominal" style="display: none;">
            <label>Nominal</label>
            <input type="text" name="id_user" class="form-control" aria-label="Default select example" required placeholder="Nama Nasabah" value="<?php echo $_SESSION['nasabah']->id_user?>" readonly hidden>
            <?php $limit = nasabahTenor()->SALDO * 10 / 100; ?>
            <input type="number" class="form-control" name="pinjaman" id="pinjaman" placeholder="Limit Peminjaman Anda : <?= rupiah($limit)?>" oninput="validateNominal2()" required>
          </div>
          <div class="form-group" id="tenorFields" style="display: none;">
            <label for="tenor">Tenor</label>
            <select name="tenor" class="form-control" id="tenor" onchange="" required>
              <option selected disabled>Pilih salah satu...</option>
              <?php $conn = globalfun(); foreach (mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM tenor")) as $data) { ?>
              <option value="<?= $data[0]?>"><?= $data[1]." Bulan - Bunga ".$data[2]." %"?></option>
              <?php }?>
            </select>
          </div>
          <div class="modal-footer" id="pinjamanFooter" style="display: none;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submitPinjaman" class="btn btn-primary">Save changes</button>
          </div>
          </form>
          <!-- end pinjaman -->
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

<?php include(__DIR__.'/../template/footer.php'); ?>