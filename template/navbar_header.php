<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

<div class="container-fluid">
    <nav class="navbar navbar-line navbar-header-left navbar-expand-lg p-0  d-none d-lg-flex">
        <ul class="navbar-nav page-navigation page-navigation-info">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    Dashboard
                </a>
            </li>
        </ul>
    </nav>
    <?php if (isset($_SESSION['users'])) { ?>
    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                    <img src="<?= base_url('assets/gambar/'.$_SESSION['users']->foto)?>" alt="..." class="avatar-img rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                            <div class="user-box">
                            <div class="avatar-lg"><img src="<?= base_url('assets/gambar/'.$_SESSION['users']->foto)?>" alt="image profile" class="avatar-img rounded"></div>
                            <div class="u-text">
                                <h4><?=$_SESSION['users']->nama?></h4>
                                <p class="text-muted"><?=$_SESSION['users']->email?></p><a href="<?=base_url('dashboard/user.php')?>" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                            </div>
                            </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url('dashboard/user.php')?>">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout.php')?>">Logout</a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
    <?php } else { ?>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                    <img src="<?= base_url('assets/gambar/'.$_SESSION['nasabah']->foto)?>" alt="..." class="avatar-img rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                            <div class="user-box">
                            <div class="avatar-lg"><img src="<?= base_url('assets/gambar/'.$_SESSION['nasabah']->foto)?>" alt="image profile" class="avatar-img rounded"></div>
                            <div class="u-text">
                                <h4><?=$_SESSION['nasabah']->nama?></h4>
                                <p class="text-muted"><?=$_SESSION['nasabah']->email?></p><a href="<?=base_url('nasabah/user.php')?>" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                            </div>
                            </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url('nasabah/user.php')?>">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout.php')?>">Logout</a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
    <?php } ?>
</div>
</nav>
<!-- End Navbar -->

<div class="main-panel full-height">