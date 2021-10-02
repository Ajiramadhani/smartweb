<p class="text-lead text-white">Masukkan email kamu untuk mendapatkan link reset password!</p>
</div>
</div>
</div>
</div>
<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Lupa passwordmu ?</h5>
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="<?= base_url('auth/forgotpassword?'); ?>">
                        <div class="mb-3">
                            <input type="text" name="email" class="form-control form-control-user" id="email" value="<?= set_value('email'); ?>" placeholder="Enter Email Address...">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Reset Sekarang</button>
                        </div>
                        <div class="text-center">
                            <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href="<?= base_url('auth'); ?>" class=" text-dark font-weight-bolder">Kembali ke Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>