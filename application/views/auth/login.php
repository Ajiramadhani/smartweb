<p class="text-lead text-white">Masukkan email dan passwordmu disini untuk login ke Smartweb</p>
</div>
</div>
</div>
</div>
<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Login disini...</h5>
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="<?= base_url('auth'); ?>">
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email anda...." value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Login</button>
                        </div>
                        <div class="text-center">
                            <p class="text-sm mt-3 mb-0">Lupa password akunmu? <a href="<?= base_url('auth/forgotpassword'); ?>" class=" text-dark font-weight-bolder">Reset disini</a></p>
                            <p class="text-sm mt-3 mb-0">Belum punya akun? <a href="<?= base_url('auth/registration'); ?>" class=" text-dark font-weight-bolder">Daftar disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>