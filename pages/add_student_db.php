<?php
include '../db.php';
include_once '../db_functions.php';
include '../pages/add_students_db_script.php';
include '../pages/edit_status_script.php';
include '../pages/edit_student_name_script.php';
include '../pages/edit_student_schedule_script.php';
session_start();

$active_students = get_students_based_on_status("Y");
$inactive_students = get_students_based_on_status("N");

$success_message = $_GET['message'];
$errMsg = $_GET['error'];

if ($_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'se' ) {

    ?>
    <!DOCTYPE html>
    <!--
<!--[if IE 8]>
    <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]>
    <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8"/>
        <title> Add/Edit Student | Timestamp</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <!-- DROPDOWN -->
        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--DATE TIME-->
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
              rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL PLUGINS -->


        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
              type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
              type="text/css"/>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components"
              type="text/css"/>
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css"
              id="style_color"/>
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME LAYOUT STYLES -->
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
              rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../assets/pages/img/favicon.png"/>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <!-- BEGIN HEADER -->
    <?php include '../sections/header.php' ?>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <?php
            include '../sections/sidebar.php';
            ?>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN THEME PANEL -->
                <!--<div class="theme-panel hidden-xs hidden-sm">
                    <div class="toggler"> </div>
                    <div class="toggler-close"> </div>
                    <div class="theme-options">
                        <div class="theme-option theme-colors clearfix">
                            <span> THEME COLOR </span>
                            <ul>
                                <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
                                <li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
                                <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                                <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
                                <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
                                <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
                            </ul>
                        </div>
                        <div class="theme-option">
                            <span> Theme Style </span>
                            <select class="layout-style-option form-control input-sm">
                                <option value="square" selected="selected">Square corners</option>
                                <option value="rounded">Rounded corners</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Layout </span>
                            <select class="layout-option form-control input-sm">
                                <option value="fluid" selected="selected">Fluid</option>
                                <option value="boxed">Boxed</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Header </span>
                            <select class="page-header-option form-control input-sm">
                                <option value="fixed" selected="selected">Fixed</option>
                                <option value="default">Default</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Top Menu Dropdown</span>
                            <select class="page-header-top-dropdown-style-option form-control input-sm">
                                <option value="light" selected="selected">Light</option>
                                <option value="dark">Dark</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Sidebar Mode</span>
                            <select class="sidebar-option form-control input-sm">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected="selected">Default</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Sidebar Menu </span>
                            <select class="sidebar-menu-option form-control input-sm">
                                <option value="accordion" selected="selected">Accordion</option>
                                <option value="hover">Hover</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Sidebar Style </span>
                            <select class="sidebar-style-option form-control input-sm">
                                <option value="default" selected="selected">Default</option>
                                <option value="light">Light</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Sidebar Position </span>
                            <select class="sidebar-pos-option form-control input-sm">
                                <option value="left" selected="selected">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span> Footer </span>
                            <select class="page-footer-option form-control input-sm">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected="selected">Default</option>
                            </select>
                        </div>
                    </div>
                </div>-->
                <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="../index.php">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Add/Edit Student Information</span>
                        </li>
                    </ul>
                    <!--<div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn yellow btn-sm btn-outline dropdown-toggle"
                                    data-toggle="dropdown"> Actions
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="icon-bell"></i> Action</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-shield"></i> Another action</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="icon-bag"></i> Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>-->
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title">Add/Edit Students
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->

                        <div class="portlet light portlet-fit bordered" >

                            <div class="portlet-title" style="">
                                <div class="caption">

                                    <?php
                                    echo "<span style='color : red;'>" . $errMsg . "</span>";
                                    $errMsg = '';
                                    echo "<span style='color : blue;'>" . $success_message . "</span>";
                                    $success_message = '';

                                    ?>
                                </div>
                            </div>
                            <div class="portlet box purple">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-plus"></i>Add New Student To Database
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>

                                    </div>
                                </div>
                                <div class="portlet-body form" ><!--style="display: none!important;"-->

                                    <!-- BEGIN FORM-->
                                    <form action="" method="post" class="form-horizontal form-bordered">
                                        <div class="form-body form">
                                            <div class="form-group">
                                            <label class="control-label col-md-3">First Name</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="new_student_first_name" placeholder=""> </div>
                                            </div>
                                        </div>
                                        <div class="form-body form">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Last Name</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="new_student_last_name" placeholder=""> </div>
                                            </div>
                                        </div>
                                        <div class="form-body form">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Student ID</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="new_student_id" placeholder=""> </div>
                                            </div>
                                        </div>


                                        <!--<div class="form-group">
                                            <label class="control-label col-md-3">Scheduled Cumulative Work Hours For Current Period </label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <input type="number" min="1" max="300" class="form-control" name="new_student_work_hours" style="width: 200px;" placeholder="Hours As Integer" >

                                                </div>
                                            </div>
                                        </div>-->

                                        <!--<div class="form-group">
                                            <label class="control-label col-md-3">Work Hours Per Week</label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <input type="number" min="1" max="30" class="form-control" name="weekly_student_hours" style="width: 200px;" placeholder="Hours As Integer" >

                                                </div>
                                            </div>
                                        </div>-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Monday</label>
                                            <div class="col-md-4">
                                                <select name="monday_hours" class="bs-select form-control">
                                                    <option value="0:00:00">None</option>
                                                    <option value="1:00:00">1:00</option>
                                                    <option value="1:30:00">1:30</option>
                                                    <option value="2:00:00">2:00</option>
                                                    <option value="2:30:00">2:30</option>
                                                    <option value="3:00:00">3:00</option>
                                                    <option value="3:30:00">3:30</option>
                                                    <option value="4:00:00">4:00</option>
                                                    <option value="4:30:00">4:30</option>
                                                    <option value="5:00:00">5:00</option>
                                                    <option value="5:30:00">5:30</option>
                                                    <option value="6:00:00">6:00</option>
                                                    <option value="6:30:00">6:30</option>
                                                    <option value="7:00:00">7:00</option>
                                                    <option value="7:30:00">7:30</option>
                                                    <option value="8:00:00">8:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tuesday</label>
                                            <div class="col-md-4">
                                                <select name="tuesday_hours" class="bs-select form-control">
                                                    <option value="0:00:00">None</option>
                                                    <option value="1:00:00">1:00</option>
                                                    <option value="1:30:00">1:30</option>
                                                    <option value="2:00:00">2:00</option>
                                                    <option value="2:30:00">2:30</option>
                                                    <option value="3:00:00">3:00</option>
                                                    <option value="3:30:00">3:30</option>
                                                    <option value="4:00:00">4:00</option>
                                                    <option value="4:30:00">4:30</option>
                                                    <option value="5:00:00">5:00</option>
                                                    <option value="5:30:00">5:30</option>
                                                    <option value="6:00:00">6:00</option>
                                                    <option value="6:30:00">6:30</option>
                                                    <option value="7:00:00">7:00</option>
                                                    <option value="7:30:00">7:30</option>
                                                    <option value="8:00:00">8:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Wednesday</label>
                                            <div class="col-md-4">
                                                <select name="wednesday_hours" class="bs-select form-control">
                                                    <option value="0:00:00">None</option>
                                                    <option value="1:00:00">1:00</option>
                                                    <option value="1:30:00">1:30</option>
                                                    <option value="2:00:00">2:00</option>
                                                    <option value="2:30:00">2:30</option>
                                                    <option value="3:00:00">3:00</option>
                                                    <option value="3:30:00">3:30</option>
                                                    <option value="4:00:00">4:00</option>
                                                    <option value="4:30:00">4:30</option>
                                                    <option value="5:00:00">5:00</option>
                                                    <option value="5:30:00">5:30</option>
                                                    <option value="6:00:00">6:00</option>
                                                    <option value="6:30:00">6:30</option>
                                                    <option value="7:00:00">7:00</option>
                                                    <option value="7:30:00">7:30</option>
                                                    <option value="8:00:00">8:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Thursday</label>
                                            <div class="col-md-4">
                                                <select name="thursday_hours" class="bs-select form-control">
                                                    <option value="0:00:00">None</option>
                                                    <option value="1:00:00">1:00</option>
                                                    <option value="1:30:00">1:30</option>
                                                    <option value="2:00:00">2:00</option>
                                                    <option value="2:30:00">2:30</option>
                                                    <option value="3:00:00">3:00</option>
                                                    <option value="3:30:00">3:30</option>
                                                    <option value="4:00:00">4:00</option>
                                                    <option value="4:30:00">4:30</option>
                                                    <option value="5:00:00">5:00</option>
                                                    <option value="5:30:00">5:30</option>
                                                    <option value="6:00:00">6:00</option>
                                                    <option value="6:30:00">6:30</option>
                                                    <option value="7:00:00">7:00</option>
                                                    <option value="7:30:00">7:30</option>
                                                    <option value="8:00:00">8:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Friday</label>
                                            <div class="col-md-4">
                                                <select name="friday_hours" class="bs-select form-control">
                                                    <option value="0:00:00">None</option>
                                                    <option value="1:00:00">1:00</option>
                                                    <option value="1:30:00">1:30</option>
                                                    <option value="2:00:00">2:00</option>
                                                    <option value="2:30:00">2:30</option>
                                                    <option value="3:00:00">3:00</option>
                                                    <option value="3:30:00">3:30</option>
                                                    <option value="4:00:00">4:00</option>
                                                    <option value="4:30:00">4:30</option>
                                                    <option value="5:00:00">5:00</option>
                                                    <option value="5:30:00">5:30</option>
                                                    <option value="6:00:00">6:00</option>
                                                    <option value="6:30:00">6:30</option>
                                                    <option value="7:00:00">7:00</option>
                                                    <option value="7:30:00">7:30</option>
                                                    <option value="8:00:00">8:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Term/Session/Semester</label>
                                            <div class="col-md-3">
                                                <select id="single" class="form-control select2"
                                                        name="student_period_id">
                                                    <option></option>
                                                    <?php
                                                    $period_list = get_period_list();
                                                    echo "<optgroup label='Period List'>";
                                                    foreach ($period_list as $period) {
                                                        echo "<option value=' " . $period['id'] . " '>" . $period['period_name'] .  " - (" . $period['start_date'] ." to ". $period['end_date'].")</option>";
                                                    }
                                                    echo "</optgroup>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-3">
                                                <input name="new_student" type="submit" class="btn purple" value="Submit">

                                            </div>
                                        </div>


                                    </form>

                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- BEGIN PORTLET-->

                            <div class="portlet box default">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-edit"></i>Edit Student Status
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>

                                    </div>
                                </div>
                                <div class="portlet-body form">

                                    <!-- BEGIN FORM-->
                                    <form action="" method="post" class="form-horizontal form-bordered">
                                        <div class="form-body form">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Select Student</label>
                                                <div class="col-md-3">
                                                    <select id="single" class="form-control select2"
                                                            name="select_student_id_for_edit_status">
                                                        <option></option>
                                                        <?php
                                                        echo "<optgroup label='Active'>";
                                                        foreach ($active_students as $active_student) {
                                                            echo "<option value=' " . $active_student['student_id'] . " '>" . $active_student['last_name'] . " " . $active_student['first_name'] . " - " . $active_student['student_id'] . "</option>";
                                                        }
                                                        echo "</optgroup>";
                                                        echo "<optgroup label=\"Inactive\">";

                                                        foreach ($inactive_students as $inactive_student) {
                                                            echo "<option value=' " . $inactive_student['student_id'] . " '>" . $inactive_student['last_name'] . " " . $inactive_student['first_name'] . " - " . $inactive_student['student_id'] . "</option>";
                                                        }
                                                        echo "</optgroup>";
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Student Status </label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio" style="position: relative; cursor: pointer;">

                                                                <input type="radio" name="change_status" id="select_active" value="Y" checked style=" margin-top: 5px;"> Active
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio" style="position: relative; cursor: pointer;">
                                                                <input type="radio" name="change_status" id="select_inactive" value="N"> Inactive
                                                                <span></span>
                                                            </label>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3"></label>
                                                <div class="col-md-3">
                                                    <input name="edit_status" type="submit" class="btn default" value="Submit">

                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <!-- END FORM-->
                                </div>
                            </div>
                            <div class="portlet box blue-sharp">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-plus"></i>Edit Student Name
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>

                                    </div>
                                </div>
                                <div class="portlet-body form" ">

                                    <!-- BEGIN FORM-->
                                    <form action="" method="post" class="form-horizontal form-bordered">
                                        <div class="form-body form">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Select Student</label>
                                                <div class="col-md-3">
                                                    <select id="single" class="form-control select2"
                                                            name="select_student_id_for_edit_name">
                                                        <option></option>
                                                        <?php
                                                        echo "<optgroup label='Active'>";
                                                        foreach ($active_students as $active_student) {
                                                            echo "<option value=' " . $active_student['student_id'] . " '>" . $active_student['last_name'] . " " . $active_student['first_name'] . " - " . $active_student['student_id'] . "</option>";
                                                        }
                                                        echo "</optgroup>";
                                                        echo "<optgroup label=\"Inactive\">";

                                                        foreach ($inactive_students as $inactive_student) {
                                                            echo "<option value=' " . $inactive_student['student_id'] . " '>" . $inactive_student['last_name'] . " " . $inactive_student['first_name'] . " - " . $inactive_student['student_id'] . "</option>";
                                                        }
                                                        echo "</optgroup>";
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">First Name</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="edit_student_first_name" placeholder=""> </div>
                                            </div>
                                        </div>
                                        <div class="form-body form">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Last Name</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="edit_student_last_name" placeholder=""> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-3">
                                                <input name="edit_student_name" type="submit" class="btn blue-sharp" value="Submit">

                                            </div>
                                        </div>


                                    </form>

                                    <!-- END FORM-->
                                </div>

                            </div>
                        <div class="portlet box yellow-casablanca">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-plus"></i>Edit Student Schedule
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>

                                </div>
                            </div>
                            <div class="portlet-body form" ><!--style="display: none!important;"-->

                                <!-- BEGIN FORM-->
                                <form action="" method="post" class="form-horizontal form-bordered">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Important!</label>
                                        <div class="col-md-4">

                                            <p>Changing student schedule after the period has begun is not advised, but should be performed on Friday evening, or Monday morning.
                                                In the case of an edit after a period has begun, the new weekly sum of hours must remain the same, or be less than original sum.</p>


                                            <!-- /input-group -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Student</label>
                                        <div class="col-md-3">
                                            <select id="single" class="form-control select2"
                                                    name="select_student_id_for_edit_schedule">
                                                <option></option>
                                                <?php
                                                echo "<optgroup label='Active'>";
                                                foreach ($active_students as $active_student) {
                                                    echo "<option value=' " . $active_student['student_id'] . " '>" . $active_student['last_name'] . " " . $active_student['first_name'] . " - " . $active_student['student_id'] . "</option>";
                                                }
                                                echo "</optgroup>";
                                                echo "<optgroup label=\"Inactive\">";

                                                foreach ($inactive_students as $inactive_student) {
                                                    echo "<option value=' " . $inactive_student['student_id'] . " '>" . $inactive_student['last_name'] . " " . $inactive_student['first_name'] . " - " . $inactive_student['student_id'] . "</option>";
                                                }
                                                echo "</optgroup>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="control-label col-md-3">Monday</label>
                                        <div class="col-md-4">
                                            <select name="monday_hours_edit" class="bs-select form-control">
                                                <option value="0:00:00">None</option>
                                                <option value="1:00:00">1:00</option>
                                                <option value="1:30:00">1:30</option>
                                                <option value="2:00:00">2:00</option>
                                                <option value="2:30:00">2:30</option>
                                                <option value="3:00:00">3:00</option>
                                                <option value="3:30:00">3:30</option>
                                                <option value="4:00:00">4:00</option>
                                                <option value="4:30:00">4:30</option>
                                                <option value="5:00:00">5:00</option>
                                                <option value="5:30:00">5:30</option>
                                                <option value="6:00:00">6:00</option>
                                                <option value="6:30:00">6:30</option>
                                                <option value="7:00:00">7:00</option>
                                                <option value="7:30:00">7:30</option>
                                                <option value="8:00:00">8:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tuesday</label>
                                        <div class="col-md-4">
                                            <select name="tuesday_hours_edit" class="bs-select form-control">
                                                <option value="0:00:00">None</option>
                                                <option value="1:00:00">1:00</option>
                                                <option value="1:30:00">1:30</option>
                                                <option value="2:00:00">2:00</option>
                                                <option value="2:30:00">2:30</option>
                                                <option value="3:00:00">3:00</option>
                                                <option value="3:30:00">3:30</option>
                                                <option value="4:00:00">4:00</option>
                                                <option value="4:30:00">4:30</option>
                                                <option value="5:00:00">5:00</option>
                                                <option value="5:30:00">5:30</option>
                                                <option value="6:00:00">6:00</option>
                                                <option value="6:30:00">6:30</option>
                                                <option value="7:00:00">7:00</option>
                                                <option value="7:30:00">7:30</option>
                                                <option value="8:00:00">8:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Wednesday</label>
                                        <div class="col-md-4">
                                            <select name="wednesday_hours_edit" class="bs-select form-control">
                                                <option value="0:00:00">None</option>
                                                <option value="1:00:00">1:00</option>
                                                <option value="1:30:00">1:30</option>
                                                <option value="2:00:00">2:00</option>
                                                <option value="2:30:00">2:30</option>
                                                <option value="3:00:00">3:00</option>
                                                <option value="3:30:00">3:30</option>
                                                <option value="4:00:00">4:00</option>
                                                <option value="4:30:00">4:30</option>
                                                <option value="5:00:00">5:00</option>
                                                <option value="5:30:00">5:30</option>
                                                <option value="6:00:00">6:00</option>
                                                <option value="6:30:00">6:30</option>
                                                <option value="7:00:00">7:00</option>
                                                <option value="7:30:00">7:30</option>
                                                <option value="8:00:00">8:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Thursday</label>
                                        <div class="col-md-4">
                                            <select name="thursday_hours_edit" class="bs-select form-control">
                                                <option value="0:00:00">None</option>
                                                <option value="1:00:00">1:00</option>
                                                <option value="1:30:00">1:30</option>
                                                <option value="2:00:00">2:00</option>
                                                <option value="2:30:00">2:30</option>
                                                <option value="3:00:00">3:00</option>
                                                <option value="3:30:00">3:30</option>
                                                <option value="4:00:00">4:00</option>
                                                <option value="4:30:00">4:30</option>
                                                <option value="5:00:00">5:00</option>
                                                <option value="5:30:00">5:30</option>
                                                <option value="6:00:00">6:00</option>
                                                <option value="6:30:00">6:30</option>
                                                <option value="7:00:00">7:00</option>
                                                <option value="7:30:00">7:30</option>
                                                <option value="8:00:00">8:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Friday</label>
                                        <div class="col-md-4">
                                            <select name="friday_hours_edit" class="bs-select form-control">
                                                <option value="0:00:00">None</option>
                                                <option value="1:00:00">1:00</option>
                                                <option value="1:30:00">1:30</option>
                                                <option value="2:00:00">2:00</option>
                                                <option value="2:30:00">2:30</option>
                                                <option value="3:00:00">3:00</option>
                                                <option value="3:30:00">3:30</option>
                                                <option value="4:00:00">4:00</option>
                                                <option value="4:30:00">4:30</option>
                                                <option value="5:00:00">5:00</option>
                                                <option value="5:30:00">5:30</option>
                                                <option value="6:00:00">6:00</option>
                                                <option value="6:30:00">6:30</option>
                                                <option value="7:00:00">7:00</option>
                                                <option value="7:30:00">7:30</option>
                                                <option value="8:00:00">8:00</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Term/Session/Semester</label>
                                        <div class="col-md-3">
                                            <select id="single" class="form-control select2"
                                                    name="edit_student_period_id">
                                                <option></option>
                                                <?php
                                                $period_list = get_period_list();
                                                echo "<optgroup label='Period List'>";
                                                foreach ($period_list as $period) {
                                                    echo "<option value=' " . $period['id'] . " '>" . $period['period_name'] .  " - (" . $period['start_date'] ." to ". $period['end_date'].")</option>";
                                                }
                                                echo "</optgroup>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-3">
                                            <input name="edit_student_schedule" type="submit" class="btn yellow-casablanca" value="Submit">

                                        </div>
                                    </div>


                                </form>

                                <!-- END FORM-->
                            </div>
                        </div>
                            <!-- END PORTLET-->


                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <!--<div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <button id="sample_editable_1_new" class="btn green"> Add New
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;"> Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"> Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"> Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                    <tr>

                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Weekly</th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th>Status</th>
                                        <th>Period</th>
                                        <th>Edit</th>
                                        <th></th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                   $get_all_students_info = get_all_students();
                                    foreach ($get_all_students_info as $student_info) {
                                        echo "<tr>";
                                        echo "<td>" . $student_info['first_name'] . " " . $student_info['last_name'] . "</td>";
                                        echo "<td>" . $student_info['student_id'] . "</td>";
                                        $schedule = get_student_schedule($student_info['student_id']);
                                        $total = time_to_seconds($schedule['mon'])+time_to_seconds($schedule['tue'])+time_to_seconds($schedule['wed'])+time_to_seconds($schedule['thu'])+time_to_seconds($schedule['fri']);
                                        $total = seconds_to_hours($total);
                                        echo "<td>" .$total. "</td>";
                                        echo "<td>". substr($schedule['mon'], 0,-3) . "</td>";
                                        echo "<td>". substr($schedule['tue'], 0,-3) ." </td>";
                                        echo "<td>". substr($schedule['wed'], 0,-3) ." </td>";
                                        echo "<td>". substr($schedule['thu'], 0,-3) ." </td>";
                                        echo "<td>". substr($schedule['fri'], 0,-3) ." </td>";
                                        echo "<td>".$student_info['is_active'] ." </td>";
                                        $period = get_period_by_id($student_info['period']);
                                        echo "<td>". $period['period_name'] ." </td>";
                                        echo "<td  >
                                        <a class=\"edit\" href=\"javascript:;\"> Edit </a>
                                    </td>
                                    <td  >
                                        <a class=\"delete\" href=\"javascript:;\"></a>
                                    </td>



                                </tr> ";
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <?php include '../sections/quicksidebar.php' ?>
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php
    include '../sections/footer.php';
    ?>
    <!-- END FOOTER -->
    <!--[if lt IE 9]>
    <script src="../assets/global/plugins/respond.min.js"></script>
    <script src="../assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->


    <!-- BEGIN CORE PLUGINS -->
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/schedule_time/table-datatables-editable.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <!-- DROPDOWN CORE PLUGINS -->

    <!--DATETIME-->
    <!-- BEGIN CORE PLUGINS -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/schedule_time/components-date-time-pickers.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script src="../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/schedule_time/components-date-time-pickers.js" type="text/javascript"></script>

    </body>

    </html>

    <?php
}else {
    header("location: /index.php");
}
?>