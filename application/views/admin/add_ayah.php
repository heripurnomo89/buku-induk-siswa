<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?= base_url('admin/index'); ?>">Admin</a>
            <a class="navbar-brand brand-logo-mini pl-4" href="<?= base_url('admin/index'); ?>">Admin</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
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
                        Form Tambah Ayah
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
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Default form</h4>
                                <form class="forms-sample" action="" method="post">
                                    <div class="form-group">
                                        <label for="siswa">Nama Siswa</label>
                                        <select class="form-control" id="siswa" name="siswa">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($siswa as $s) : ?>
                                            <option value="<?= $s->idsiswa; ?>"><?= $s->nmSiswa; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger"><?= form_error('siswa'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Ayah</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama.."
                                            name="nama" value="<?= set_value('nama'); ?>">
                                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal lahir</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="<?= set_value('tanggal'); ?>">
                                        <small class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan</label>
                                        <select class="form-control" id="Pendidikan" name="pendidikan">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($pendidikan as $p) : ?>
                                            <option value="<?= $p; ?>"><?= $p; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger"><?= form_error('pendidikan'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <select class="form-control" id="Pekerjaan" name="pekerjaan">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($peker as $p) : ?>
                                            <option value="<?= $p; ?>"><?= $p; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger"><?= form_error('pekerjaan'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="penghasilan">Penghasilan</label>
                                        <select class="form-control" id="Penghasilan" name="penghasilan">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($peng as $p) : ?>
                                            <option value="<?= $p; ?>"><?= $p; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger"><?= form_error('penghasilan'); ?></small>
                                    </div>

                                    <a href="<?= base_url('admin/ayah'); ?>">
                                        <button type="button" class="btn btn-danger float-right">Kembali</button>
                                    </a>
                                    <button type="submit"
                                        class="btn btn-gradient-primary float-right mr-2">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->