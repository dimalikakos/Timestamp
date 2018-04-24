<?php
include '../db.php';
include_once '../db_functions.php';
include_once 'periods_script.php';
session_start();

$period_list = get_period_list();

$success_message = $_GET['message'];
$errMsg = $_GET['error'];

if ($_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'se') {

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
        <title> Terms/Sessions | Timestamp</title>
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
                            <span>Edit Terms/Sessions</span>
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
                <?php
                $active_period = get_active_period();
                ?>


                <h3 class="page-title">Current Active Period: <span style="color: palevioletred"><?php echo $active_period['period_name']; ?></span>
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



                                    /*$endDate = strtotime("2016-09-07");
                                    for($i = strtotime('Tuesday', strtotime("2016-08-06")); $i <= $endDate; $i = strtotime('+1 week', $i))
                                        echo date('l Y-m-d', $i);*/


                                    ?>
                                </div>
                            </div>

                        </div>
                        <!-- END PORTLET-->
                        <div class="portlet-body">
                            <div class="table-toolbar">

                            </div>
                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                <tr>

                                    <th>Term/Session/Semester Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>

                                    <th style="display: none;" >Edit</th>
                                    <th style="display: none;" >Delete</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($period_list as $period) {
                                    echo "<tr>";
                                    if ($period['current_period'] == 'Y'){
                                        $background = "lightblue";
                                        $is_current = " (Active Period)";
                                    }else{
                                        $background = "none";
                                        $is_current = "";
                                    }
                                    echo "<td style='background-color: ".$background." '>" . $period['period_name'] . $is_current." </td>";
                                    echo "<td style='background-color: ".$background." '>" . $period['start_date'] . "</td>";
                                    echo "<td style='background-color: ".$background." '>" . $period['end_date'] . "</td>";

                                    echo "<td style=\"display: none;\" >
                                        <a class=\"edit\" href=\"javascript:;\"> Edit </a>
                                    </td>
                                    <td style=\"display: none;\" >
                                        <a class=\"delete\" href=\"javascript:;\"> Delete </a>
                                    </td>



                                </tr> ";
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="portlet box yellow-casablanca">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-plus-circle"></i>Add New Term/Session/Semester
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" > </a>

                                </div>
                            </div>
                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="" method="post" class="form-horizontal form-bordered">
                                    <div class="form-body form">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Date Range For Term/Session/Semester</label>

                                            <div class="col-md-3">
                                                <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control" name="period_date_range_from">
                                                    <span class="input-group-addon"> to </span>
                                                    <input type="text" class="form-control" name="period_date_range_to">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body form">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Name of Term/Session/Semester (example: Fall 2016)</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="period_name" placeholder=""> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-3">
                                            <input name="add_new_period" type="submit" class="btn yellow-casablanca" value="Submit">
                                        </div>
                                    </div>

                                </form>


                                <!-- END FORM-->
                            </div>
                        </div>
                        <div class="portlet box blue-steel">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit"></i>Change Term/Session/Semester Date Range
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" > </a>

                                </div>
                            </div>
                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="" method="post" class="form-horizontal form-bordered">
                                    <div class="form-body form">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Term/Session/Semester</label>
                                            <div class="col-md-3">
                                                <select id="single" class="form-control select2"
                                                        name="select_period_id_for_edit">
                                                    <option></option>
                                                    <?php
                                                    echo "<optgroup label='Period List'>";
                                                    foreach ($period_list as $period) {
                                                        echo "<option value=' " . $period['id'] . " '>" . $period['period_name'] .  " - (" . $period['start_date'] ." to ". $period['end_date'].")</option>";
                                                    }
                                                    echo "</optgroup>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body form">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select New Date Range </label>

                                            <div class="col-md-3">
                                                <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control" name="edit_period_date_range_from">
                                                    <span class="input-group-addon"> to </span>
                                                    <input type="text" class="form-control" name="edit_period_date_range_to">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-3">
                                            <input name="edit_period_range" type="submit" class="btn blue-steel" value="Submit">
                                        </div>
                                    </div>

                                </form>


                                <!-- END FORM-->
                            </div>
                        </div>
                        <div class="portlet box green-sharp">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit"></i>Select Current Active Period
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" > </a>

                                </div>
                            </div>
                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="" method="post" class="form-horizontal form-bordered">
                                    <div class="form-body form">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Term/Session/Semester</label>
                                            <div class="col-md-3">
                                                <select id="single" class="form-control select2"
                                                        name="select_period_id">
                                                    <option></option>
                                                    <?php
                                                    echo "<optgroup label='Period List'>";
                                                    foreach ($period_list as $period) {
                                                        echo "<option value=' " . $period['id'] . " '>" . $period['period_name'] .  " - (" . $period['start_date'] ." to ". $period['end_date'].")</option>";
                                                    }
                                                    echo "</optgroup>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-3">
                                            <input name="select_current_period" type="submit" class="btn green-sharp" value="Submit">
                                        </div>
                                    </div>

                                </form>


                                <!-- END FORM-->
                            </div>
                        </div>

                        <div class="portlet box red-haze">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-eraser"></i>Delete Period (Must be Inactive)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" > </a>

                                </div>
                            </div>
                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="" method="post" class="form-horizontal form-bordered">
                                    <div class="form-body form">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Term/Session/Semester</label>
                                            <div class="col-md-3">
                                                <select id="single" class="form-control select2"
                                                        name="select_period_id_for_deletion">
                                                    <option></option>
                                                    <?php
                                                    echo "<optgroup label='Period List'>";
                                                    foreach ($period_list as $period) {
                                                        if ($period['current_period'] == 'N') {
                                                            echo "<option value=' " . $period['id'] . " '>" . $period['period_name'] . " - (" . $period['start_date'] . " to " . $period['end_date'] . ")</option>";
                                                        }
                                                    }
                                                    echo "</optgroup>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-3">
                                            <input name="select_current_period_for_deletion" type="submit" class="btn red-haze" value="Submit">
                                        </div>
                                    </div>

                                </form>


                                <!-- END FORM-->
                            </div>
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
    <script src="../assets/pages/scripts/table-datatables-editable.js" type="text/javascript"></script>
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
    <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script src="../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datepicker/special_datepicker/bootstrap-datepicker.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
            type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    </body>

    </html>

    <?php
}else {
    header("location: /index.php");
}
?>