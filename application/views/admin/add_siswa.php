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
                            <i class="mdi mdi-account"></i>
                        </span>
                        Form Tambah Siswa
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
                    <div class="col-md-10 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Default form</h4>
                                <form class="forms-sample" action="" method="post">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama.."
                                            name="nama" value="<?= set_value('nama'); ?>">
                                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="jenis" id="jenis"
                                                        value="Laki - Laki" <?= set_radio('jenis', 'Laki - Laki'); ?> />
                                                    Laki -Laki

                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="jenis" id="jenis"
                                                        value="Perempuan" <?= set_radio('jenis', 'Perempuan'); ?> />
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nis">NIS</label>
                                        <input type="text" class="form-control" id="nis" placeholder="Nis..." name="nis"
                                            value="<?= set_value('nis'); ?>">
                                        <small class="form-text text-danger"><?= form_error('nis'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <input type="text" class="form-control" id="nisn" placeholder="Nisn..."
                                            name="nisn" value="<?= set_value('nisn'); ?>">
                                        <small class="form-text text-danger"><?= form_error('nisn'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" placeholder="Nik..." name="nik"
                                            value="<?= set_value('nik'); ?>">
                                        <small class="form-text text-danger"><?= form_error('nik'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="angkatan">Angkatan</label>
                                        <select class="form-control" id="angkatan" name="angkatan">
                                            <option value="">-- pilih --</option>
                                            <?php for ($a = 2010; $a <= date('Y'); $a++) { ?>
                                            <option value="<?= $a; ?>"><?= $a; ?></option>
                                            <?php }; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tmp">Tempat lahir</label>
                                        <input type="text" class="form-control" id="tmp" placeholder="Tempat lahir..."
                                            name="tmp" value="<?= set_value('tmp'); ?>">
                                        <small class="form-text text-danger"><?= form_error('tmp'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal lahir</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="<?= set_value('tanggal'); ?>">
                                        <small class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($agama as $a) : ?>
                                            <option value="<?= $a; ?>"><?= $a; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder="Alamat.."
                                            name="alamat" value="<?= set_value('alamat'); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="dusun">Dusun</label>
                                        <input type="text" class="form-control" id="dusun" placeholder="Dusun..."
                                            name="dusun" value="<?= set_value('dusun'); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="desa">Desa</label>
                                        <input type="text" class="form-control" id="desa" placeholder="Desa.."
                                            name="desa" value="<?= set_value('desa'); ?>">

                                    </div>

                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan.."
                                            name="kecamatan" value="<?= set_value('kecamatan'); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="kode">Kode Pos</label>
                                        <input type="text" class="form-control" id="kode" placeholder="Kode.."
                                            name="kode" value="<?= set_value('kode'); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="tinggal">Tempat Tinggal</label>
                                        <select class="form-control" id="tinggal" name="tinggal">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($tinggal as $t) : ?>
                                            <option value="<?= $t->idtinggal; ?>"><?= $t->nmTinggal; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger"><?= form_error('tinggal'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="alat">Alat Transportasi</label>
                                        <select class="form-control" id="alat" name="alat">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($trans as $t) : ?>
                                            <option value="<?= $t->idtransportasi; ?>"><?= $t->nmTransportasi; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="telpon">Nomor Telp</label>
                                        <input type="text" class="form-control" id="telpon" placeholder="telpon.."
                                            name="telpon" value="<?= set_value('telpon'); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="email.."
                                            name="email" value="<?= set_value('email'); ?>">
                                        <small class="form-text text-danger"><?= form_error('email'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="bansos">KPS</label>
                                        <input type="text" class="form-control" id="bansos" placeholder="bansos.."
                                            name="bansos" value="<?= set_value('bansos'); ?>">

                                    </div>
                                    <a href="<?= base_url('admin/Siswa'); ?>">
                                        <button type="button" class="btn btn-danger float-right">Kembali</button>
                                    </a>
                                    <button type="submit"
                                        class="btn btn-gradient-primary float-right mr-2">Simpan</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->