<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-center px-5 pb-5 pt-3">
                        <img src="<?= base_url('assets/') ?>images/logo-min.png" alt="logo"
                            class="rounded-circle border border-light" width="90" height="90">
                        <?= $this->session->flashdata('message'); ?>
                        <h6 class="font-weight-light pt-3">Sign in to continue.</h6>

                        <form class="pt-3" action="<?= base_url('auth/index'); ?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" id="exampleInputEmail1"
                                    placeholder="Username" name="username" value="<?= set_value('username'); ?>">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                    placeholder="Password" name="password">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="text-center">
                                <a href="<?= base_url('auth/lupaPassword'); ?>">
                                    <small>lupa password</small>
                                </a>
                            </div>
                            <div class="mt-3">
                                <button type="submit"
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                    IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>