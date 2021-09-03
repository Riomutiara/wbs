<!-- Query Menu -->
<?php
$role_id = $this->session->userdata('role_id');
$queryMenu = "SELECT `user_menu`.`id`, `menu`, `icon`
                FROM `user_menu` JOIN `user_access_menu` 
                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
              ORDER BY `user_access_menu`.`menu_id` ASC
                ";
$menu = $this->db->query($queryMenu)->result_array();
?>
<!-- End query Menu -->



<!-- Horizontal navigation-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <?php foreach ($menu as $m) : ?>
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a class="dropdown-toggle nav-link" href="index.html" data-toggle="dropdown">
                        <i class="<?= $m['icon']; ?>"></i>
                        <span><?= $m['menu']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $menuId = $m['id'];                        
                        $querySubMenu = "SELECT *
                                    FROM `user_sub_menu`                                     
                                    WHERE `menu_id` = $menuId                                    
                                    AND `is_active` = 1
                                    ";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>
                        
                        <?php foreach ($subMenu as $sm) : ?>
                            <li data-menu=""><a class="dropdown-item" href="<?= base_url($sm['url']); ?>" data-toggle="dropdown"><?= $sm['title']; ?>
                                    <submenu class="name"></submenu>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Horizontal navigation-->

<!-- Content -->
<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">