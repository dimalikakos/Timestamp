<?php
include '../db.php';
include_once '../db_functions.php';
include 'find_date_script.php';
include 'find_work_logs_script.php';
session_start();

$student_logs_from = $_GET['student_date_range_from'];
$student_logs_to = $_GET['student_date_range_to'];
$student_logs_id = $_GET['student_id'];

$student_info = get_student_info($student_logs_id);

$old_date_from = date('l, F d Y ',strtotime($student_logs_from));
$old_date_timestamp_from = strtotime($old_date_from);
$date_formatted_from = date('l, F d, Y', $old_date_timestamp_from);
$date_formatted_for_DB_from = date('Y-m-d', $old_date_timestamp_from);

$old_date_to = date('l, F d Y ',strtotime($student_logs_to));
$old_date_timestamp_to = strtotime($old_date_to);
$date_formatted_to = date('l, F d, Y', $old_date_timestamp_to);
$date_formatted_for_DB_to = date('Y-m-d', $old_date_timestamp_to);

$active_students = get_students_based_on_status("Y");
$inactive_students = get_students_based_on_status("N");
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
        <title>Student Work Hours For Student <?php echo $student_info[0]['first_name'] . ' ' . $student_info[0]['last_name'] ?> (<?php echo $student_logs_from ?> to <?php echo $student_logs_to ?> ) | Timestamp </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
                            <span>Work Logs</span>
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
                <h3 class="page-title" style="font-size: 20px;"> <span>Showing work hours for student <span style="color: red; font-weight: bolder;"><?php echo $student_info[0]['first_name']." ".$student_info[0]['last_name'] ?></span> for period <span style="color: red; font-weight: bolder;"><?php echo $date_formatted_from ?></span> to <span style="color: red; font-weight: bolder;"><?php echo $date_formatted_to ?></span>. </span></h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                <!--<div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Select Date Range For Cumulative View
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="in expand"> </a>

                        </div>
                    </div>
                    <div class="portlet-body form" style="display: none!important;">

                        <form action="" method="post" class="form-horizontal form-bordered">
                            <div class="form-body form">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Date Range</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                            <input type="text" class="form-control" name="cumulative_from">
                                            <span class="input-group-addon"> to </span>
                                            <input type="text" class="form-control" name="cumulative_to">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-3">
                                        <input name="find_date_cumulative" type="submit" class="btn blue-hoki">
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Work Logs for Student
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                            <tr>
                                <th> Student Name</th>
                                <th> Student ID</th>
                                <th> Work Log ID</th>
                                <th> Date Worked</th>
                                <th> Day </th>
                                <th> Start Time</th>
                                <th> End Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $all_student_logs = get_all_work_logs_of_student_in_period ($student_logs_id,$date_formatted_for_DB_from,$date_formatted_for_DB_to);

                            foreach ($all_student_logs as $student_work_log) {
                                echo '<tr>';
                                echo '<td>' . $student_info[0]['first_name'] . ' ' . $student_info[0]['last_name'] . '</td>';
                                echo '<td>' . $student_work_log['student_id'] . '</td>';
                                echo '<td> #' . $student_work_log['id'] . '</td>';
                                if ($_SESSION['account_type'] != 'sa'){
                                    $link = 'href="/pages/single.php?date_page='.$student_work_log['date_worked'].'"';
                                }else{
                                    $link = 'style = "text-decoration: none; color: #34495e; "';
                                }
                                echo '<td><a '.$link.' >' . $student_work_log['date_worked']. '</a></td>';
                                echo '<td>' . date('l', strtotime($student_work_log['date_worked'])) . '</td>';
                                echo '<td>' . $student_work_log['start_time'] . '</td>';
                                echo '<td>' . $student_work_log['end_time'] . '</td>';
                                echo '</tr>';

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="portlet box yellow-gold">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Select Date Range
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
                                    <label class="control-label col-md-3">Student Name</label>
                                    <div class="col-md-3">
                                        <select id="single" class="form-control select2"
                                                name="select_student_id">
                                            <option></option>
                                            <?php
                                            echo "<optgroup label='Active'>";
                                            foreach ($active_students as $active_student) {
                                                echo "<option value=' " . $active_student['student_id'] . " '>" . $active_student['last_name'] . " " . $active_student['first_name'] . " - " . $active_student['student_id'] . "</option>";
                                            }
                                            echo "</optgroup>";
                                            echo "<optgroup label=\"Inactive\">";

                                            foreach ($inactive_students as $inactive_student) {
                                                echo "<option value='#' disabled=\"disabled\">" . $inactive_student['last_name'] . " " . $inactive_student['first_name'] . " - " . $inactive_student['student_id'] . "</option>";
                                            }
                                            echo "</optgroup>";
                                            ?>
                                        </select>
                                        <span style="color: red;"><?php echo $errMsg; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Select Date Range</label>

                                    <div class="col-md-3">
                                        <div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                            <input type="text" class="form-control" name="student_date_range_from">
                                            <span class="input-group-addon"> to </span>
                                            <input type="text" class="form-control" name="student_date_range_to">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-3">
                                    <input name="find_student_logs" type="submit" class="btn yellow-gold" value="Submit">
                                </div>
                            </div>

                        </form>


                        <!-- END FORM-->
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
    <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
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