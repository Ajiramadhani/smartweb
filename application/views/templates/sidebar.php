<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= base_url(); ?>">
            <img src="<?= base_url('assets/'); ?>img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <strong class="ms-1 font-weight-bold">IAUS!</strong>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <?php foreach ($menu as $m) : ?>
            <li class="nav-item mt-3">
                <h5 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"><?= $m['menu']; ?></h5>
            </li>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
                            FROM `user_sub_menu` JOIN `user_menu` 
                            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id` = $menuId
                            AND `user_sub_menu`.`is_active` = 1
                        ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <?php if ($title == $sm['title']) : ?>
                            <a class="nav-link active">
                            <?php else : ?>
                                <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                                <?php endif; ?>
                                <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                </div>
                                <span class="nav-link-text ms-1"><?= $sm['title']; ?></span>
                                </a>
                            <?php endforeach; ?>
                            <hr class="sidebar-divider mt-3">
                        <?php endforeach; ?>
                            </a>
                </li>
            </ul>
    </div>
</aside>
<!-- End of Sidebar -->