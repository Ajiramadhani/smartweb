<p class="text-lead text-white">Daftarkan email dan passwordmu disini untuk akses login ke Smartweb</p>
</div>
</div>
</div>
</div>
<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Daftar disini...</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="<?= base_url('auth/registration?'); ?>">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control form-control-user" id="name" value="<?= set_value('name'); ?>" placeholder="Nama Lengkap">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="email" class="form-control form-control-user" id="email" value="<?= set_value('email'); ?>" placeholder="Alamat Email">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password1" class="form-control form-control-user" id="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Repeat Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftarkan Sekarang</button>
                        </div>
                        <div class="text-center">
                            <p class="text-sm mt-3 mb-0">Lupa password akunmu? <a href="<?= base_url('auth/forgotpassword'); ?>" class=" text-dark font-weight-bolder">Reset disini</a></p>
                            <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href="<?= base_url('auth'); ?>" class=" text-dark font-weight-bolder">Kembali ke Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>