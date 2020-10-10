<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?= base_url('admin/index'); ?>">Admin</a>
            <a class="navbar-brand brand-logo-mini pl-4" href="<?= base_url('admin/index'); ?>">Admin</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-center h-100" action="<?= base_url('admin/ibu'); ?>" method="post">
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0" name="keyword"
                            placeholder="Search...">
                        <input class="btn btn-sm btn-gradient-primary " type="submit" name="submit" value="Cari">
                    </div>
                </form>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-text-mini">
                            <p class="mb-1 text-black">
                                <?= $panggilan['nama']; ?>
                            </p>
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
                                <span class="font-weight-bold mb-2">
                                    <?= $panggilan['nama']; ?> </span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/index'); ?>">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/Siswa'); ?>">
                        <span class="menu-title">Siswa</span>
                        <i class="mdi mdi-account menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Orang tua</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/ayah'); ?>">Ayah</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/ibu'); ?>">Ibu</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/wali'); ?>">
                        <span class="menu-title">Wali</span>
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="border-bottom">
                        <span class="menu-title"></span>
                    </div>
                </li>
                <li class="nav-item ">
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
                            <i class="mdi mdi-account-multiple"></i>
                        </span>
                        Ibu
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
                <div class="row">
                    <div class="col-lg-10 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title pb-3">
                                    <a href="<?= base_url('admin/addIbu'); ?>">
                                        <button type="button" class="btn btn-outline-primary btn-rounded">
                                            <i class="mdi mdi-plus"></i> Tambah Data Ibu
                                        </button>
                                    </a>
                                </h5>
                                <h4 class="ml-1">Jumlah : <?= $total_rows; ?></h4>
                                <?= $this->session->flashdata('message2'); ?>

                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Pendidikan</th>
                                            <th>Pekerjaan</th>
                                            <th>Penghasilan</th>
                                            <th>Siswa</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($ibu)) : ?>
                                        <tr>
                                            <td>
                                                <h5 class="alert alert-danger" role="alert">Data tidak ditemukan!</h5>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php

                                        foreach ($ibu as $i) : ?>
                                        <tr>
                                            <td><?= ++$start; ?></td>
                                            <td><?= $i->nama; ?></td>
                                            <td><?= date('d/m/Y', strtotime($i->lahir)); ?></td>
                                            <td><?= $i->pendidikan; ?></td>
                                            <td><?= $i->pekerjaan; ?></td>
                                            <td><?= $i->penghasilan; ?></td>
                                            <td><?= $i->nmSiswa; ?></td>
                                            <td><a href="<?= base_url('admin/editIbu/'); ?><?= $i->idibu; ?>"
                                                    class="badge badge-info">
                                                    <i class="mdi mdi-lead-pencil"></i> edit</a>
                                                <a href="<?= base_url('admin/delIbu/'); ?><?= $i->idibu; ?>"
                                                    class="badge badge-danger" onclick="return confirm('Anda yakin');">
                                                    <i class="mdi mdi-cup"></i> hapus</a></td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?= $this->pagination->create_links(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->