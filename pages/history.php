<?php
include '../db.php';
include_once '../db_functions.php';
include 'find_date_script.php';
session_start();

$history_from = $_GET['history_from'];
$history_to = $_GET['history_to'];


$old_date_from = date('l, F d Y ',strtotime($history_from));
$old_date_timestamp_from = strtotime($old_date_from);
$date_formatted_from = date('l, F d, Y', $old_date_timestamp_from);
$date_formatted_for_DB_from = date('Y-m-d', $old_date_timestamp_from);

$old_date_to = date('l, F d Y ',strtotime($history_to));
$old_date_timestamp_to = strtotime($old_date_to);
$date_formatted_to = date('l, F d, Y', $old_date_timestamp_to);
$date_formatted_for_DB_to = date('Y-m-d', $old_date_timestamp_to);


if ($_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'sa') {

    ?>
    <!DOCTYPE html>
    <!--
    -->
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
        <title>History (<?php echo $history_from ?> to <?php echo $history_to ?> ) | Timestamp </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
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
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
              rel="stylesheet" type="text/css"/>
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
                            <span>History</span>
                        </li>
                    </ul>
                    <!--<div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
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
                <h3 class="page-title"> <span>Showing period from <span style="color: red; font-weight: bolder;"><?php echo $date_formatted_from ?></span> to <span style="color: red; font-weight: bolder;"><?php echo $date_formatted_to ?></span>. </span></h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Select Date Range For History
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="in expand"> </a>

                        </div>
                    </div>
                    <div class="portlet-body form" style="display: none!important;">

                        <!-- BEGIN FORM-->
                        <form action="" method="post" class="form-horizontal form-bordered">
                            <div class="form-body form">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Date Range</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                            <input type="text" class="form-control" name="history_from">
                                            <span class="input-group-addon"> to </span>
                                            <input type="text" class="form-control" name="history_to">
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-3">
                                        <input name="find_date_history" type="submit" class="btn blue-hoki" value="Submit">
                                    </div>
                                </div>
                            </div>

                        </form>

                        <!-- END FORM-->
                    </div>
                </div>
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-clock-o"></i>History
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                            <tr>
                                <th> User</th>
                                <th> Work Log ID</th>
                                <th> Student ID</th>
                                <th> Student Name</th>
                                <th> Date Page</th>
                                <th> Action Occurred</th>
                                <th> What Happened</th>
                                <th> Timestamp</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $history = get_history_in_period($date_formatted_for_DB_from,$date_formatted_for_DB_to." 23:59:59");
                            foreach ($history as $historical_event) {

                                $user_info = get_user_info($historical_event['user_id']);
                                echo '<tr>';
                                echo '<td>' . $user_info['first_name'] ." ".$user_info['last_name']. '</td>';
                                echo '<td> #' . $historical_event['log_id'] . '</td>';
                                echo '<td>' . $historical_event['student_id'] . '</td>';
                                $student_name = get_student_info($historical_event['student_id']);
                                echo '<td>' . $student_name[0]['first_name'] ." ". $student_name[0]['last_name']. '</td>';
                                if ($_SESSION['account_type'] != 'sa'){
                                    $link = 'href="/pages/single.php?date_page='.$historical_event['date_page'].'"';
                                }else{
                                    $link = 'style = "text-decoration: none; color: #34495e; "';
                                }
                                echo '<td> <a '.$link.'>' .$historical_event['date_page']. '</a></td>';
                                echo '<td>'.$historical_event['action_occurred'].'</td>';
                                echo '<td>'.$historical_event['what_happened'].'</td>';
                                echo '<td>'.$historical_event['history_timestamp'].'</td>';
                                echo '</tr>';

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                <?php
                if ($_SESSION['account_type'] == 'ad') {
                    ?>
                    <div class="portlet box red-pink">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-trash-o"></i>Select Date Range For DELETION.
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="in expand"> </a>

                            </div>
                        </div>
                        <div class="portlet-body form" style="display: none!important;">

                            <!-- BEGIN FORM-->
                            <form action="" method="post" class="form-horizontal form-bordered">
                                <div class="form-body form">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Important!</label>
                                        <div class="col-md-4">

                                            Deletion is permanent. Start and End date history will also be deleted.
                                            Please backup any data before deleting.
                                            <!-- /input-group -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date Range</label>
                                        <div class="col-md-4">
                                            <div class="input-group input-large date-picker input-daterange"
                                                 data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control" name="delete_history_from">
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="delete_history_to">
                                            </div>
                                            <!-- /input-group -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-3">
                                            <input name="delete_history" type="submit" class="btn red-pink"
                                                   value="Delete"
                                                   onclick="return confirm('Are you sure you want to delete selected history period?');">
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <!-- END FORM-->
                        </div>
                    </div>
                    <?php
                }
                ?>


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
    <?php include '../sections/footer.php' ?>
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
    <script src="../assets/global/plugins/datatables/datatables.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/table-datatables-buttons.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
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