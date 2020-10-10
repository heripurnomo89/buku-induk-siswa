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
                        <input type="text" class="form-control bg-transparent border-0" name="keyword"
                            placeholder="Search...">
                        <input type="submit" class="btn btn-primary" name="submit" value="Cari">
                    </div>
                </form>
            </div>
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
                        <span class="menu-item"></span>
                    </div>
                    </span>
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
                            <i class="mdi mdi-account-plus"></i>
                        </span>
                        User
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
                                <h5 class="card-title pb-3">
                                    <button type="button" class="btn btn-outline-primary btn-rounded"
                                        data-toggle="modal" data-target="#tambah">

                                        <i class="mdi mdi-plus"></i> Tambah User
                                    </button>
                                </h5>
                                <?= $this->session->flashdata('message'); ?>
                                <!-- Modal -->
                                <div class="modal fade" id="tambah" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample"
                                                    action="<?= base_url('kepalasekolah/addAdmin'); ?>" method="post">
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            placeholder="Nama..." name="nama"
                                                            value="<?= set_value('nama'); ?>">
                                                        <small
                                                            class="form-text text-danger"><?= form_error('nama'); ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="Email..." name="email"
                                                            value="<?= set_value('email'); ?>">
                                                        <small
                                                            class="form-text text-danger"><?= form_error('email'); ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            placeholder="Username..." name="username"
                                                            value="<?= set_value('username'); ?>">
                                                        <small
                                                            class="form-text text-danger"><?= form_error('username'); ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            placeholder="Password..." name="password">
                                                        <small
                                                            class="form-text text-danger"><?= form_error('password'); ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role">Role</label>
                                                        <select name="role" id="role" class="form-control">
                                                            <option value="">- Pilih -</option>
                                                            <option value="1"
                                                                <?= set_value('role') == 1 ? 'selected' : null; ?>>
                                                                kepala sekolah</option>
                                                            <option value="2"
                                                                <?= set_value('role') == 2 ? 'selected' : null; ?>>Admin
                                                            </option>
                                                        </select>
                                                        <small
                                                            class="form-text text-danger"><?= form_error('role'); ?></small>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="tambah"
                                                            class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($user as $s) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $s->nama; ?></td>
                                            <td><?= $s->email; ?></td>
                                            <td><?= $s->username; ?></td>
                                            <td><?= $s->role_id == 1 ? "kepala sekolah" : "Admin"; ?></td>
                                            <td><a href="<?= base_url('kepalasekolah/edit/'); ?><?= $s->id; ?>"
                                                    class="badge badge-info">
                                                    <i class="mdi mdi-lead-pencil"></i> edit</a>
                                                <a href="<?= base_url('kepalasekolah/hapus/'); ?><?= $s->id; ?>"
                                                    class="badge badge-danger" onclick="return confirm('Anda yakin');">
                                                    <i class="mdi mdi-cup"></i> hapus</a></td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <?= redirect('auth/blocked'); ?>
            <?php endif; ?>
            <!-- content-wrapper ends -->