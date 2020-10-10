<?php if ($this->session->userdata('role') == 1) : ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?= base_url('kepalasekolah/index'); ?>">Kepsek</a>
            <a class="navbar-brand brand-logo-mini pl-4" href="<?= base_url('kepalasekolah/index'); ?>">Kepsek</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-center h-100" action="#" method="post">
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0" name="Keyword"
                            placeholder="Search...">
                        <input class="btn btn-primary" type="submit" name="Submit" value="Cari">
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
                            <i class="mdi mdi-account-multiple"></i>
                        </span>
                        Siswa
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h1 align="center" class="card-title">
                                    DATA INDUK SISWA
                                </h1>

                                <h4 class="ml-1">Jumlah : <?= $total_rows; ?></h4>

                                <table class="table table-responsive table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nama Lengkap</th>
                                            <th rowspan="2">Jenis Kelamin</th>
                                            <th rowspan="2">NIS</th>
                                            <th rowspan="2">NISN</th>
                                            <th rowspan="2">NIK</th>
                                            <th rowspan="2">Angkatan</th>
                                            <th rowspan="2">Tempat, Tanggal Lahir</th>
                                            <th rowspan="2">Agama</th>
                                            <th rowspan="2">Alamat</th>
                                            <th rowspan="2">Nama dusun</th>
                                            <th rowspan="2">Kelurahan/Desa</th>
                                            <th rowspan="2">Kecamatan</th>
                                            <th rowspan="2">Kode Pos</th>
                                            <th rowspan="2">Jenis Tinggal</th>
                                            <th rowspan="2">Alat Transportasi</th>
                                            <th rowspan="2">No. Telp</th>
                                            <th rowspan="2">E-mail</th>
                                            <th rowspan="2">Penerima Kps</th>
                                            <th colspan="2">Orang tua</th>
                                            <th rowspan="2">Wali</th>
                                        </tr>

                                        <tr align="center">
                                            <th>Ayah</th>
                                            <th>Ibu</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php if (empty($murid)) : ?>
                                        <tr>
                                            <td>
                                                <h5 class="alert alert-danger " role="alert">Data tidak
                                                    ditemukan!</h5>
                                            </td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php

                                            foreach ($murid as $s) : ?>
                                        <tr align="center">
                                            <td><?= ++$start; ?></td>
                                            <td><?= $s->nmSiswa; ?></td>
                                            <td><?= $s->jenisKelamin; ?></td>
                                            <td><?= $s->nis; ?></td>
                                            <td><?= $s->nisn; ?></td>
                                            <td><?= $s->nik; ?></td>
                                            <td><?= $s->angkatan; ?></td>
                                            <td><?= $s->tempatLhr . ", " . date('d/m/Y', strtotime($s->tglLhr)); ?></td>
                                            <td><?= $s->agama; ?></td>
                                            <td><?= $s->alamat; ?></td>
                                            <td><?= $s->dusun; ?></td>
                                            <td><?= $s->desa; ?></td>
                                            <td><?= $s->kecamatan; ?></td>
                                            <td><?= $s->kodePos; ?></td>
                                            <td><?= $s->nmTinggal; ?></td>
                                            <td><?= $s->nmTransportasi; ?></td>
                                            <td><?= $s->telpon; ?></td>
                                            <td><?= $s->email; ?></td>
                                            <td><?= $s->bansos; ?></td>
                                            <td><?= $s->nmAyah; ?></td>
                                            <td><?= $s->nmIbu; ?></td>
                                            <td><?= $s->nmWali; ?></td>
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
            <?php else : ?>
            <?= redirect('auth/blocked'); ?>
            <?php endif; ?>
            <!-- content-wrapper ends -->