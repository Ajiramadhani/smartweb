<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <a href="<?= base_url('admin/user'); ?>" class="btn btn-primary mb-3">Back</a>

            <?php foreach ($pengguna as $k) { ?>
                <form class="form" method="post" action="<?php echo base_url('admin/user_update'); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama User" value="<?php echo $k->name; ?>">
                        <input type="hidden" name="id" value="<?php echo $k->id_user; ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            <?php foreach ($role as $r) { ?>
                                <option value="<?= $r->id; ?>"><?= $r->role; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $k->email; ?>" disabled>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Update User</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>