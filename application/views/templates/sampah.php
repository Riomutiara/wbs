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


<!-- Sidebar  -->
<aside id="sidebar_left" class="">
    <!-- Sidebar Left Wrapper  -->
    <div class="sidebar-left-content nano-content">
        <!-- Sidebar Menu  -->
        <ul class="nav sidebar-menu">
            <?php foreach ($menu as $m) : ?>
                <li class="">
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon <?= $m['icon']; ?>"></span>
                        <span class="sidebar-title"><?= $m['menu']; ?></span>
                    </a>
                    <ul class="nav sub-nav">
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
                            <li>
                                <a href="<?= base_url($sm['url']); ?>">
                                    <?= $sm['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- /Sidebar Menu  -->
    </div>
    <!-- /Sidebar Left Wrapper  -->
</aside>
<!-- /Sidebar -->
<!-- Main Wrapper -->
<section id="content_wrapper">
    <section class="content_container">
        <!-- Topbar Menu Wrapper -->
        <div id="topbar-dropmenu-wrapper">
            <div class="topbar-menu row">
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-danger">
                        <span class="fa fa-music"></span>
                        <span class="service-title">Audio</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-success">
                        <span class="fa fa-picture-o"></span>
                        <span class="service-title">Images</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-primary">
                        <span class="fa fa-video-camera"></span>
                        <span class="service-title">Videos</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-alert">
                        <span class="fa fa-envelope"></span>
                        <span class="service-title">Messages</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-system">
                        <span class="fa fa-cog"></span>
                        <span class="service-title">Settings</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-dark">
                        <span class="fa fa-user"></span>
                        <span class="service-title">Users</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Topbar Menu Wrapper -->
        <!-- Topbar -->
        <header id="topbar" class="breadcrumb_style_2">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon breadcrumb-active">
                        <a href="index.html">
                            <span class="fa fa-circle-o"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-icon breadcrumb-link">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-current-item">Horizontal navigation small menu</li>
                </ol>
            </div>
            <div class="topbar-right">
                <div class="ib topbar-dropdown">
                    <label for="topbar-multiple" class="control-label">Reporting Period</label>
                    <select id="topbar-multiple" class="hidden">
                        <optgroup label="Filter By:">
                            <option value="1-1">Last 30 Days</option>
                            <option value="1-2" selected="selected">Last 60 Days</option>
                            <option value="1-3">Last Year</option>
                        </optgroup>
                    </select>
                </div>
                <div class="ml15 ib va-m" id="sidebar_right_toggle">
                    <div class="navbar-btn btn-group btn-group-number mv0">
                        <button class="btn btn-sm prn pln">
                            <i class="fa fa-bar-chart fs22 text-default"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Topbar -->