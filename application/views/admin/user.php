<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUser">Add New User</a>
            <div class="col-lg-8 pl-2">
                <?= $this->session->flashdata('sukses'); ?>
            </div>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status Akun</th>
                        <th scope="col">Tanggal di Buat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pengguna as $p) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $p->name; ?></td>
                            <td><?= $p->email; ?></td>
                            <td><img width="150px" class="img-responsive" src="<?= base_url('assets/img/profile/') . $p->image; ?>" alt=""></td>
                            <td><?= $p->role; ?></td>
                            <td><?= $p->is_active; ?></td>
                            <td><?= date("d-m-Y H:i:s", $p->date_created); ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="<?= base_url('admin/user_edit/') . $p->id_user; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a onclick="javascript: return confirm('Are you sure to delete ?')" class="btn btn-danger btn-sm" href="<?= base_url('admin/hapus_user/') . $p->id_user; ?>"><i class="fas fa-pencil-alt"></i> Hapus</a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>