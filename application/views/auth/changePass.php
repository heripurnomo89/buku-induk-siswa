<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-center px-5 pb-5 pt-3">
                        <img src="<?= base_url('assets/') ?>images/logo-min.png" alt="logo"
                            class="rounded-circle border border-light" width="90" height="90">
                        <?= $this->session->flashdata('message'); ?>
                        <h6 class="font-weight-light pt-3">Reset password anda!</h6>

                        <form class="pt-3" action="<?= base_url('auth/changePassword'); ?>" method="post">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" placeholder="Password"
                                    name="password">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="Ulangi Password" name="password2">
                                <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="mt-3">
                                <button type="submit"
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Reset
                                    Password</button>
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