<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <title>Dashboard | Emigo b</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Emigo" name="description" />
    <meta content="CVS" name="author" />
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/images/favicon.ico">
    <link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/css/datepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link href="<?php echo base_url();?>assets/admin/css/admin-custom-styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

    <!-- <body data-layout="horizontal"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?php echo base_url();?>admin/dashboard" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?php echo base_url();?>assets/admin/images/emigo-logo-sm.png" alt=""
                                    height="">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url();?>assets/admin/images/emigo_logo.png" alt="" height="">
                                <span class="logo-txt"></span>
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url();?>assets/admin/images/emigo_logo.png" alt="" height="">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url();?>assets/admin/images/emigo_logo.png" alt="" height="">
                                <span class="logo-txt"></span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                </div>

                <div class="d-flex">





                    <div class="dropdown d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block d-none">
                        <button type="button" class="btn header-item noti-icon position-relative"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i data-feather="bell" class="icon-lg"></i>
                            <span class="badge bg-danger rounded-pill">5</span>
                        </button>
                        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline"> Unread (105)</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Quotation Approved</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Approved your Quotation, for the Lead - Asas</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>06/05/2024 04:45 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task - Site Visit, for the Lead - LEAD18</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>10/04/2024 02:09 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task -    *c, for the Lead - New lead 170000</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>09/04/2024 12:16 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task - Site Visit, for the Lead - Yyy</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>05/04/2024 05:50 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task - Site Visit, for the Lead - ABHI TEST LEAD</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>07/03/2024 01:14 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task -    *c, for the Lead - Sdsd</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>07/03/2024 12:49 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task - Site Visit, for the Lead - Infoprak 10th Oct2023</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>10/10/2023 04:24 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Quotation Approved</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Approved your Quotation, for the Lead - Lead by asifrahiman</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>09/12/2022 03:35 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task - new work, for the Lead - Lead by asifrahiman</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>09/12/2022 03:19 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="fa fa-bell"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">You have a new Task</h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">Asif Rahiman, Assigned a new Task - Quotation, for the Lead - Lead by asifrahiman</p>
                                                <p class="mb-0"><i class="fa fa-calendar"></i> <span>09/12/2022 03:19 PM</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>







                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="fa fa-check-square"></i> <span>View More..</span>
                        </a>
                    </div>
                </div> -->
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item right-bar-toggle me-2">

                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="<?php echo base_url();?>assets/admin/images/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">Emigo Admin</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 9px;"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url()?>admin/logout"><i
                                    class="fa-solid fa-right-from-bracket me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>


        <!-- ========== Left Sidebar Start ========== -->

        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->




                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">





                        <!-- <li>
                            <a target="_blank" href="<?php echo base_url(); ?>website/home">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Visit Website</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url(); ?>admin/dashboard">
                                <!-- <i data-feather="home"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/dashboard-icon.svg" />
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/country">
                                <!-- <i data-feather="home"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/country-icon.svg" />
                                <span data-key="t-dashboard">Country</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/tax">
                                <!-- <i data-feather="home"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/tax-icon.svg" />
                                <span data-key="t-dashboard">Tax</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/package">
                                <!-- <i data-feather="home"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/packages-icon.svg" />
                                <span data-key="t-dashboard">Packages</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript: void(0);">
                                <!-- <i data-feather="archive"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/store-icon.svg" />
                                <span data-key="t-apps">Store</span>
                                <!-- <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i> -->
                            </a>


                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/store/add">

                                        <span data-key="t-calendar">Add Store</span>

                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/store">
                                        <span data-key="t-calendar">View Stores</span>

                                    </a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="<?php echo base_url(); ?>admin/qrcodes">-->
                                <!--        <span data-key="t-calendar">Generate QR</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                            </ul>

                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <!-- <i data-feather="users"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/catalog-icon.svg" />
                                <span data-key="t-apps">Catalog</span>
                                <!-- <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i> -->
                            </a>


                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/Categories/">
                                        <span data-key="t-calendar">Categories</span>

                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo base_url(); ?>admin/subCategories/">
                                        <span data-key="t-calendar">SubCategories</span>

                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo base_url(); ?>admin/product">
                                        <span data-key="t-calendar">Products</span>

                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/Cooking">
                                        <span data-key="t-dashboard">Cooking Requests</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/variants">
                                        <span data-key="t-dashboard">Variants</span>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <!-- <i data-feather="users"></i> -->
                                <img src="<?php echo base_url();?>assets/admin/images/admin-user-icon.svg" />
                                <span data-key="t-apps">User</span>
                                <!-- <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i> -->
                            </a>


                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/user/add">
                                        <span data-key="t-calendar">Add User</span>

                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/user">
                                        <span data-key="t-calendar">View Users</span>

                                    </a>
                                </li>
                            </ul>

                        </li>

                        <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>

                                    <span data-key="t-apps">Lead</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Add User</span>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">View Users</span>

                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>

                                    <span data-key="t-apps">Employee</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Add Employee</span>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">View Employees</span>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Employee Allocation</span>

                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="archive"></i>

                                    <span data-key="t-apps">Companyyy</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Add Branch</span>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">View Branches</span>

                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="box"></i>

                                    <span data-key="t-apps">Product</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Add Product</span>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">View Products</span>
                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="database"></i>

                                    <span data-key="t-apps">Project</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Add Project</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">View Projects</span>
                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="edit"></i>

                                    <span data-key="t-apps">Quotation</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Quotation Approval</span>
                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>

                                    <span data-key="t-apps">User Management</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">User Roles</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Menus &amp; Views</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">User Privileges</span>
                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="book"></i>

                                    <span data-key="t-apps">Reports</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Lead Report</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span data-key="t-calendar">Task Report</span>
                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="user"></i>

                                    <span data-key="t-apps">Client</span>
                                    <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="addclient.html">
                                                <span data-key="t-calendar">Add Client</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span data-key="t-calendar">View Clients</span>
                                            </a>
                                        </li>
                                </ul>

                            </li>
                            <li class="mm-active">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="book"></i>

                                    <span data-key="t-apps">Master</span>
                                     <i class="fa-solid fa-chevron-right " style="float: right; font-size: 9px;"></i>
                                </a>


                                <ul class="sub-menu" aria-expanded="false" id="main-sub-menu">
                                        <li>
                                            <a href="employeetype.html">
                                                <span data-key="t-calendar">Employee Types</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="industrytype.html">
                                                <span data-key="t-calendar">Industry Types</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="department.html">
                                                <span data-key="t-calendar">Department</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="designation.html">
                                                <span data-key="t-calendar">Designation</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="leadsource.html">
                                                <span data-key="t-calendar">Lead Source</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="projecttype.html">
                                                <span data-key="t-calendar">Project Type</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="workflow.html">
                                                <span data-key="t-calendar">Work Flow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="certificate.html">
                                                <span data-key="t-calendar">Certificates</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="country.html">
                                                <span data-key="t-calendar">Country</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="induction.html">
                                                <span data-key="t-calendar">Induction</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pass.html">
                                                <span data-key="t-calendar">Pass</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="state.html">
                                                <span data-key="t-calendar">State</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="religion.html">
                                                <span data-key="t-calendar">Religion</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="qualification.html">
                                                <span data-key="t-calendar">Qualification</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="projecttag.html">
                                                <span data-key="t-calendar">Project Tag</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="productunit.html">
                                                <span data-key="t-calendar">Product Unit</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="productcategory.html">
                                                <span data-key="t-calendar">Product Category</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="taxs.html">
                                                <span data-key="t-calendar">Taxs</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="scaffoldingtype.html">
                                                <span data-key="t-calendar">Scaffolding Type</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="scopeofwork.html">
                                                <span data-key="t-calendar">Scope of Work</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="swl.html">
                                                <span data-key="t-calendar">Swl</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="quotecertificate.html">
                                                <span data-key="t-calendar">Quote Certificate</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="worktype.html">
                                                <span data-key="t-calendar">Work Type</span>
                                            </a>
                                        </li>
                                </ul>

                            </li> -->


                    </ul>
                </div>

                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->