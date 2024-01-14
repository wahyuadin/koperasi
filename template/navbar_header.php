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
    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                    <img src="<?= base_url('assets/img/profile.jpg')?>" alt="..." class="avatar-img rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg"><img src="<?= base_url('assets/img/profile.jpg')?>" alt="image profile" class="avatar-img rounded"></div>
                            <div class="u-text">
                                <h4>Hizrian</h4>
                                <p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout.php')?>">Logout</a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
</div>
</nav>
<!-- End Navbar -->

<div class="main-panel full-height">