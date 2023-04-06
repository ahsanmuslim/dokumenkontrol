<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $data['title'] ?></title>

	<link rel="shortcut icon" href="<?= BASEURL ?>/icon/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= BASEURL ?>/css/sb-dark-themes.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/sweetalert2.min.css" rel="stylesheet">

        <!-- Script for Chart js-->
    <link href="<?= BASEURL; ?>/css/Chart.min.css">
    <script src="<?= BASEURL; ?>/js/Chart.min.js"></script>
    <script src="<?= BASEURL; ?>/js/popper.min.js"></script>
    <!-- <script src="<?= BASEURL; ?>/js/ckeditor.js"></script> -->
    <script src="<?= BASEURL; ?>/vendor/ckeditor/ckeditor.js"></script>

    <script src="<?= BASEURL; ?>/js/jquery-3.5.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/fh-3.3.1/r-2.4.0/sc-2.0.7/sb-1.4.0/sp-2.1.0/datatables.min.css"/>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center bg-gray-900" href="<?= BASEURL; ?>/home">
                <div class="sidebar-brand-icon">
                    <img src="<?= BASEURL ?>/icon/favicon-32x32.png" alt="firman" class="shadow">
                </div>
            </a>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php
            use Teckindo\DokumenKontrol\Helper\ParsingURL;

            $data['doc'] = $this->model('Jenis')->getJenisAll();

            $uri = ParsingURL::parseURL();
            $controller = $uri[0];

            $activeclass = "";
            $textactive = "";

            foreach ($data['menu'] as $menu):

            if($controller == $menu['url']){
                $activeclass = 'active';
                $textactive = 'text-warning';
            } else {
                $activeclass = "";
                $textactive = "";
            }

            if($menu['url'] == 'document'){ ?>

                <li class="nav-item mb-0 <?= $activeclass ?>">
                    <a class="nav-link collapsed pb-0 <?= $textactive ?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="<?= $menu['icon'] ?> <?= $textactive ?>"></i>
                        <span><?= $menu['title'] ?></span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="py-2 bg-white collapse-inner rounded">
                            <a class="collapse-item" href="<?= BASEURL ?>/<?= $menu['url'] ?>">All Dokumen</a>
                            <?php foreach($data['doc'] as $doc): ?>

                            <a class="collapse-item" href="<?= BASEURL ?>/<?= $menu['url'] ?>/jenis/<?= $doc['url_menu'] ?>"><?= $doc['jenis'] ?></a>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>

            <?php } else { ?>

                <li class="nav-item mb-0 <?= $activeclass ?>">
                    <a class="nav-link pb-0 <?= $textactive ?>" href="<?= BASEURL ?>/<?= $menu['url'] ?>">
                        <i class="<?= $menu['icon'] ?> <?= $textactive ?>"></i>
                        <span><?= $menu['title'] ?></span>
                    </a>
                </li>

            <?php }  ?>

            <?php endforeach; ?>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow border-bottom-warning">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-light d-md-none rounded-circle mr-3">
                        <i class="fas fa-bars text-dark"></i>
                    </button>

                    <p class="font-weight-bold h6 text-warning"><a href="<?= BASEURL ?>" class="text-warning text-decoration-none">Document Control</a></p>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw" data-toggle="tooltip" title="Notification"></i>
                                <!-- Counter - Alerts -->
                            </a>

                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header bg-dark border-dark">
                                Notification
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-comment-dots text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">no message here</div>
                                    </div>
                                </a>              
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notification</a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small"><?= $data['userlogin']['nama_user'] ?></span>
                                <img class="img-profile rounded-circle" src="<?= BASEURL ?>/img/<?= $data['userlogin']['profile'] ?>" alt="profile">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="<?= BASEURL ?>/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= BASEURL ?>/log">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

            