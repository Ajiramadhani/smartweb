<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <a href="<?= base_url('admin/role'); ?>" class="btn btn-primary mb-3">Back</a>

            <?php foreach ($role as $k) { ?>
                <form class="form-inline pb-5 pt-3" method="post" action="<?php echo base_url('admin/role_update'); ?>">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="role" class="sr-only">Nama Menu</label>
                        <input type="hidden" name="id" value="<?php echo $k->id; ?>">
                        <input type="text" class="form-control" name="role" id="role" placeholder="Masukkan Nama Menu" value="<?php echo $k->role; ?>">
                        <?php echo form_error('role'); ?>
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Update Menu</button>
                </form>
            <?php } ?>
        </div>
    </div>