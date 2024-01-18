<div class="sidebar" data-background-color="dark">	
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<?php if (isset($_SESSION['users'])) { ?>
								<img src="<?= base_url('assets/gambar/'.$_SESSION['users']->foto)?>" alt="..." class="avatar-img rounded-circle">
							<?php } else { ?>
								<img src="<?= base_url('assets/gambar/'.$_SESSION['nasabah']->foto)?>" alt="..." class="avatar-img rounded-circle">
							<?php } ?>
						</div>
						<div class="info">
							<a data-toggle="collapse" h aria-expanded="true">
								<?php if (isset($_SESSION['users'])) { ?>
								<span>
									<?= $_SESSION['users']->nama?>
									<span class="user-level"><?= $_SESSION['users']->id_user?></span>
								</span>
								<?php } else { ?>
									<span>
										<?= $_SESSION['nasabah']->nama?>
										<span class="user-level"><?= $_SESSION['nasabah']->id_user?></span>
									</span>
								<?php }?>
							</a>
						</div>
					</div>
					<ul class="nav nav-warning">
						<li class="nav-item 
						<?php if (isset($_SESSION['users'])) {
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$active_class = (strpos($actual_link, 'dashboard/index.php') !== false) ? 'active' : '';
							echo $active_class;;
						} else {
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$active_class = (strpos($actual_link, 'nasabah/index.php') !== false) ? 'active' : '';
							echo $active_class;;
						}
						?>">
						<?php if (isset($_SESSION['users'])) { ?>
							<a href="<?= base_url('dashboard/index.php')?>" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
							<?php } else { ?>
								<a href="<?= base_url('nasabah/index.php')?>" class="collapsed" aria-expanded="false">
									<i class="fas fa-home"></i>
									<p>Dashboard</p>
								</a>

							<?php } ?>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Finance</h4>
						</li>
						<li class="nav-item
						<?php 
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$active_class = (strpos($actual_link, 'master-laporan') !== false) ? 'active' : '';
							echo $active_class;
						?>">
						<?php if (isset($_SESSION['users'])) { ?>
							<a href="<?= base_url('dashboard/master-laporan.php')?>">
								<i class="fas fa-chart-bar"></i>
								<p>Master Laporan</p>
							</a>
							<?php } else { ?>
								<a href="<?= base_url('nasabah/master-laporan.php')?>">
									<i class="fas fa-wallet"></i>
									<p>Data Tabungan</p>
								</a>
						<?php } ?>
						</li>
						<li class="nav-item
						<?php 
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$active_class = (strpos($actual_link, 'pemasukan') !== false) ? 'active' : '';
							echo $active_class;
						?>">
						<?php if (isset($_SESSION['users'])) { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#messages-app-nav">
									<i class="far fa-file-excel"></i>
									<p>Pemasukan Report</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="messages-app-nav">
									<ul class="nav nav-collapse">
										<li>
											<a href="<?= base_url('dashboard/pemasukan.php')?>">
												<span class="sub-item">Data Pemasukan</span>
											</a>
										</li>
										<li>
											<a href="<?= base_url('dashboard/pengajuan-pemasukan.php')?>">
												<span class="sub-item">Pengajuan Pemasukan</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<?php } else { ?>
								<a href="<?= base_url('nasabah/pemasukan.php')?>">
									<i class="far fa-file-excel"></i>
									<p>Pemasukan Report</p>
								</a>
						<?php }?>
						</li>
						<li class="nav-item
						<?php 
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$active_class = (strpos($actual_link, 'pengeluaran') !== false) ? 'active' : '';
							echo $active_class;
						?>">
						<?php if (isset($_SESSION['users'])) { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#pengeluaran">
									<i class="fas fa-file-contract"></i>
									<p>Pengeluaran Report</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="pengeluaran">
									<ul class="nav nav-collapse">
										<li>
											<a href="<?= base_url('dashboard/pengeluaran.php')?>">
												<span class="sub-item">Data Pengeluaran</span>
											</a>
										</li>
										<li>
											<a href="<?= base_url('dashboard/pengajuan-pengeluaran.php')?>">
												<span class="sub-item">Pengajuan Pengeluaran</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<?php } else { ?>
								<a href="<?= base_url('nasabah/pengeluaran.php')?>">
									<i class="fas fa-file-contract"></i>
									<p>Pengeluaran Report</p>
								</a>
						<?php } ?>
						</li>
						<?php if (isset($_SESSION['users'])) { ?>
							<li class="nav-item
							<?php 
								$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								$active_class = (strpos($actual_link, 'tenor') !== false) ? 'active' : '';
								echo $active_class;
							?>">
								<a href="<?= base_url('dashboard/tenor.php')?>">
								<i class="fas fa-percent"></i>
										<p>Tenor</p>
								</a>
							</li>
						<?php }?>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">NASABAH</h4>
						</li>
						<?php
						$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						$tagihan = (strpos($actual_link, 'tagihan') !== false) ? 'active' : '';
						if (isset($_SESSION['users'])) {?>
							<li class="nav-item <?= $tagihan?>">
								<a href="<?= base_url('dashboard/tagihan.php')?>">
									<i class="fas fa-credit-card"></i>
									<p>Data Tagihan</p>
								</a>
							</li>
							<?php } else { ?>
								<li class="nav-item <?= $tagihan?>">
									<a href="<?= base_url('nasabah/tagihan.php')?>">
										<i class="fas fa-credit-card"></i>
										<p>Data Tagihan</p>
									</a>
								</li>
						<?php }  ?>
						<li class="nav-item
						<?php 
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$active_class = (strpos($actual_link, 'history') !== false) ? 'active' : '';
							echo $active_class;
						?>">
						<?php if (isset($_SESSION['users'])) {?>
							<a href="<?= base_url('dashboard/history.php')?>">
								<i class="fas fa-history"></i>
								<p>History Transaksi</p>
							</a>
						<?php } else { ?>
							<a href="<?= base_url('nasabah/history.php')?>">
								<i class="fas fa-history"></i>
								<p>History Transaksi</p>
							</a>
						<?php }?>
						</li>
						<?php if (isset($_SESSION['users'])) { ?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#user">
								<i class="far fa-user"></i>
								<p>User</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="user">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= base_url('dashboard/user.php')?>">
											<span class="sub-item">Data User</span>
										</a>
									</li>
									<li>
										<a href="<?= base_url('dashboard/detail-user.php')?>">
											<span class="sub-item">Detail User</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<?php } else { ?>
							<li class="nav-item
							<?php 
								$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								$active_class = (strpos($actual_link, 'user') !== false) ? 'active' : '';
								echo $active_class;
							?>">
								<a href="<?= base_url('nasabah/user.php')?>">
									<i class="far fa-user"></i>
									<p>User</p>
								</a>
							</li>
						<?php } ?>
						<!-- <li class="nav-item">
							<a href="invoice.html">
								<i class="fas fa-file-invoice-dollar"></i>
								<p>Invoices</p>
								<span class="badge badge-count">6</span>
							</a>
						</li> -->
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->