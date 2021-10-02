<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-primary mb-3">Back</a>

            <?php foreach ($sub as $s) { ?>
                <form class="form" method="POST" action="<?= base_url('menu/sub_update'); ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="hidden" name="id" value="<?php echo $s->id_sub; ?>">
                        <input type="text" class="form-control" name="title" id="title" value="<?= $s->title; ?>">
                        <?php echo form_error('title'); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu_id">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <?php foreach ($user_menu as $m) { ?>
                                <option <?php if ($s->menu_id == $m->id) {
                                            echo "selected='selected'";
                                        } ?> value="<?= $m->id; ?>"><?= $m->menu; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" name="icon" id="icon" value="<?= $s->icon; ?>">
                        <?php echo form_error('icon'); ?>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" name="url" id="url" value="<?= $s->url; ?>">
                        <?php echo form_error('url'); ?>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active ?
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            <?php } ?>
        </div>
    </div>