<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["isLogin"])) {
    echo '<script>
			window.location = "home";
		</script>';
}

// get class for menu items
require_once 'controller/CtrMenu.php';

$menu_Items = CtrMenu::MenuCtrl();

$fetchMenuItems = $menu_Items->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost:122/paws/apps/" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Rails ERP Admin </title>
    <link rel="icon" type="image/x-icon" href="template/statics/assets/img/favicon.ico" />
    <link href="template/statics/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="template/statics/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="template/statics/assets/css/fonts.css" rel="stylesheet">
    <link href="template/statics/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- NAV-->

    <link href="template/statics/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />

    <!-- CHARTS -->
    <link href="template/statics/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="template/statics/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- USER STYLES -->>
    <link rel="stylesheet" type="text/css" href="template/statics/plugins/dropify/dropify.min.css">
    <link href="template/statics/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />

    <link href="template/statics/assets/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />

    <link href="template/statics/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="template/statics/assets/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="template/statics/assets/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="template/statics/assets/plugins/table/datatable/dt-global_style.css">

    <!--  MODALS-->
    <link href="template/statics/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

    <!--CONTACTS -->
    <link rel="stylesheet" type="text/css" href="template/statics/assets/css/forms/theme-checkbox-radio.css">
    <link href="template/statics/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />

    <!-- sweet alert -->
    <script src="template/statics/assets/plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="template/statics/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />

    <!-- sales pipeline -->
    <link href="template/statics/assets/css/apps/scrumboard.css" rel="stylesheet" type="text/css" />
    <link href="template/statics/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css">

    <link href="template/statics/assets/css/elements/popover.css" rel="stylesheet" type="text/css" />

    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px) !important;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="index-2.html">
                        <img src="template/statics/assets/img/logo.svg" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="javascript:void(0)" class="nav-link"> Rails ERP </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">

                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="template/statics/assets/img/profile-16.jpg" alt="avatar">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="user_profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> Profile</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="apps_mailbox.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                        <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                    </svg> Inbox</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="apps_mailbox.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                        <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                    </svg> File Manager</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="auth_lockscreen.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg> Lock Screen</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="auth_login.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg> Sign Out</a>
                            </div>
                        </div>
                    </div>
                </li>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <div class="page-title">

                <li class="menu">
                    <a href="../dashboard" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span> Dashboard</span>
                        </div>
                    </a>
                </li>

    </div>
    </div>
    </li>
    </ul>
    </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <!--
                    <li class="menu">
                        <a href="admin" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span> Dashboard</span>
                            </div>
                        </a>
                    </li>
                    -->

                    <?php
                    foreach ($fetchMenuItems as $mt) {
                        $menu_ID = $mt['menu_ID'];
                    ?>
                        <li class="menu">
                            <a href="#<?php echo $mt['menu_slug']; ?>" title="<?php echo $mt['menu_title']; ?>" data-active="false" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                <div class="">
                                    <?php echo $mt['menu_svg_icon']; ?>
                                    <span><?php echo $mt['menu_description']; ?></span>
                                </div>

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>

                                </div>
                            </a>


                            <ul class="submenu list-unstyled collapse" id="<?php echo $mt['menu_slug']; ?>" data-parent="#accordionExample">

                                <?php
                                $getSubMenu = CtrMenu::subMenuCtr($menu_ID);

                                $cntSubMenu = $getSubMenu->rowCount();

                                if ($cntSubMenu > 0) {
                                    $fetchSubMenu = $getSubMenu->fetchAll();

                                    foreach ($fetchSubMenu as $sbm) {

                                ?>

                                        <li>
                                            <a href="../<?php echo $sbm['sub_menu_slug']; ?>"><?php echo $sbm['sub_menu_description']; ?> </a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>

                            </ul>

                        </li>

                    <?php
                    }
                    ?>

                </ul>

            </nav>

        </div>