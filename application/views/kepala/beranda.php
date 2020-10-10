<?php if ($this->session->userdata('role') == 1) : ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?= base_url('kepalasekolah/index'); ?>">Kepsek</a>
            <a class="navbar-brand brand-logo-mini pl-4" href="<?= base_url('kepalasekolah/index'); ?>">Kepsek</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-text-mini">
                            <p class="mb-1 text-black"><?= $panggilan['nama']; ?></p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                            <i class="mdi mdi-logout mr-2 text-primary"></i>
                            Signout
                        </a>
                    </div>
                </li>
                <li class="nav-item nav-settings d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <img src="<?= base_url('assets/'); ?>images/logo-min.png" alt="logo"
                            class="rounded-circle border border-light" width="50" height="50">
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <div class="border-bottom">
                        <div class="nav-link">
                            <div class="nav-profile-text">
                                <span class="font-weight-bold mb-2"><?= $panggilan['nama']; ?></span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('kepalasekolah/index'); ?>">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('kepalasekolah/admin'); ?>">
                        <span class="menu-title">User</span>
                        <i class="mdi mdi-account-plus menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('kepalasekolah/SIswa'); ?>">
                        <span class="menu-title">Siswa</span>
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="border-bottom">
                        <span class="menu-title"></span>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                        <span class="menu-title">Sign out</span>
                        <i class="mdi mdi-power menu-icon"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-home"></i>
                        </span>
                        Dashboard
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview
                                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                <?= $this->session->flashdata('message2'); ?>
                <div class="row">

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?= base_url('assets/'); ?>images/dashboard/circle.svg"
                                    class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Jumlah User
                                    <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-2"><?= $this->db->get('user')->num_rows(); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?= base_url('assets/'); ?>images/dashboard/circle.svg"
                                    class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Jumlah Siswa
                                    <i class="mdi mdi-human mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-2"><?= $this->db->get('siswa')->num_rows(); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <?= redirect('auth/blocked') ?>
            <?php endif; ?>
            <!-- content-wrapper ends -->