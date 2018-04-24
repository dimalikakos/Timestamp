<?php
include '../db.php';
include_once '../db_functions.php';
include 'find_date_script.php';
include 'add_subtract_script.php';
session_start();

$cumulative_from = $_GET['cumulative_from'];
$cumulative_to = $_GET['cumulative_to'];


$old_date_from = date('l, F d Y ',strtotime($cumulative_from));
$old_date_timestamp_from = strtotime($old_date_from);
$date_formatted_from = date('l, F d, Y', $old_date_timestamp_from);
$date_formatted_for_DB_from = date('Y-m-d', $old_date_timestamp_from);

$old_date_to = date('l, F d Y ',strtotime($cumulative_to));
$old_date_timestamp_to = strtotime($old_date_to);
$date_formatted_to = date('l, F d, Y', $old_date_timestamp_to);
$date_formatted_for_DB_to = date('Y-m-d', $old_date_timestamp_to);


$to_date = strtotime($date_formatted_for_DB_to);
$from_date = strtotime($date_formatted_for_DB_from);
$days = $to_date - $from_date;
$days = floor($days/(60*60*24));
$weeks = intval($days/7);

$active_students = get_students_based_on_status("Y");
$inactive_students = get_students_based_on_status("N");

$errMsg = $_GET['error'];
$success_message = $_GET['success'];

$viewing_period = $_GET['period_id'];

$viewing_period_info = get_period_by_id($viewing_period);
$period_list = get_period_list();


if ($_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'sa') {

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
        <title>Cumulative Datatable for <?php echo $viewing_period_info['period_name'] ?> (<?php echo $cumulative_from ?> to <?php echo $cumulative_to ?> ) | Timestamp </title>
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
        <style>
            #cumulative_info p {
                padding: 5px;
            }
        </style>
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
                            <span>Cumulative Datatable</span>
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
                <h3 class="page-title"> <span>Showing period : <span style="color: red; font-weight: bolder;"><?php echo $viewing_period_info['period_name'] ?></span> from <span style="color: red; font-weight: bolder;"><?php echo $date_formatted_from ?></span> to <span style="color: red; font-weight: bolder;"><?php echo $date_formatted_to ?>.</h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet-title" style="">
                    <div class="caption">
                        <?php
                        echo "<span style='color : red;'>" . $errMsg . "</span>";
                        $errMsg = '';
                        echo "<span style='color : blue;'>" . $success_message."</span>";
                        $success_message = '';
                        ?>
                    </div>
                </div>

                <div class="portlet box blue-steel">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Change Term/Session/Semester
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
                                    <label class="control-label col-md-3">Change Term/Session/Semester</label>
                                    <div class="col-md-3">
                                        <select id="single" class="form-control select2"
                                                name="selected_period_for_cumulative">
                                            <option value=""></option>
                                            <?php
                                            echo "<optgroup label='Period List'>";
                                            foreach ($period_list as $period) {
                                                echo "<option value='" . $period['id'] . "'>" . $period['period_name'] .  " - (" . $period['start_date'] ." to ". $period['end_date'].")</option>";
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
                                    <input name="change_period" type="submit" class="btn blue-steel" value="Submit">
                                </div>
                            </div>

                        </form>


                        <!-- END FORM-->
                    </div>
                </div>
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Cumulative Work-Hours for Students
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                            <tr>
                                <th> Student Name</th>
                                <th> Student ID</th>
                                <th> Scheduled Hours</th>
                                <th> Hours Worked</th>
                                <th> Hours Correction</th>
                                <th> Total Hours</th>
                                <th>-/+ Indicator</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            //$all_students = get_students_based_on_status('Y');

                            $all_students = get_current_period_active_students($viewing_period);
                            $week_days = array('mon', 'tue', 'wed', 'thu', 'fri');

                            foreach ($all_students as $student) {
                                $hours_counter = strtotime("1970-01-01 00:00:00 UTC");

                                $student_schedule = get_student_schedule($student['student_id']);

                                $endDate = strtotime($date_formatted_for_DB_to);
                                $startDate = strtotime($date_formatted_for_DB_from);

                                foreach ($week_days as $week_day) {
                                    $day_counter = 0;
                                    for ($i = strtotime($week_day, $startDate); $i <= $endDate; $i = strtotime('+1 week', $i)) {
                                        $day_counter++;
                                    }
                                    $multiplication = multiply_time($student_schedule[$week_day],$day_counter);
                                    $hours_counter = add_time($hours_counter,$multiplication);

                                }
                                echo '<tr>';
                                echo '<td>' . $student['last_name'] . ' ' . $student['first_name'] . '</td>';
                                echo '<td>' . $student['student_id'] . '</td>';
                                echo '<td>' . seconds_to_hours($hours_counter) . '</td>';
                                $time_worked_in_seconds = get_work_log_hours_of_student_in_period($student['student_id'] , $date_formatted_for_DB_from,$date_formatted_for_DB_to);
                                echo '<td>' . seconds_to_hours($time_worked_in_seconds) . '</td>';
                                echo '<td>' . seconds_to_hours($student['plus_minus']) . '</td>';
                                echo '<td>' . seconds_to_hours($time_worked_in_seconds + $student['plus_minus']) .'</td>'; //TOTAL HOURS WORKED HERE

                                $plus_minus_indicator = $time_worked_in_seconds + $student['plus_minus'] - $hours_counter;
                                if ($plus_minus_indicator >= 0){
                                    $background = "lightblue";
                                    $sign = "+";
                                }else {
                                    $background = "pink";
                                    $sign = "";
                                }

                                echo '<td style="background-color: '.$background.';"><span>'.$sign.'</span>' .seconds_to_hours($plus_minus_indicator). '</td>';
                                echo '</tr>';
                            }

                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <?php
                if ($_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'ad' ) {
                    ?>

                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-edit"></i>Edit Plus/Minus Indicator for Student
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
                                                    name="select_student_id_for_alteration">
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
                                        <label class="control-label col-md-3">Add Hours to Indicator</label>
                                        <div class="col-md-4">
                                            <select name="add_altered_hours" class="bs-select form-control">
                                                <option value="none">None</option>
                                                <option value="0:30:00">0:30</option>
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
                                        <label class="control-label col-md-3">Subtract Hours from Indicator</label>
                                        <div class="col-md-4">
                                            <select name="sub_altered_hours" class="bs-select form-control">
                                                <option value="none">None</option>
                                                <option value="0:30:00">- 0:30</option>
                                                <option value="1:00:00">- 1:00</option>
                                                <option value="1:30:00">- 1:30</option>
                                                <option value="2:00:00">- 2:00</option>
                                                <option value="2:30:00">- 2:30</option>
                                                <option value="3:00:00">- 3:00</option>
                                                <option value="3:30:00">- 3:30</option>
                                                <option value="4:00:00">- 4:00</option>
                                                <option value="4:30:00">- 4:30</option>
                                                <option value="5:00:00">- 5:00</option>
                                                <option value="5:30:00">- 5:30</option>
                                                <option value="6:00:00">- 6:00</option>
                                                <option value="6:30:00">- 6:30</option>
                                                <option value="7:00:00">- 7:00</option>
                                                <option value="7:30:00">- 7:30</option>
                                                <option value="8:00:00">- 8:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Reason (Optional)</label>
                                        <div class="col-md-4">
                                            <select name="reason" class="bs-select form-control">
                                                <option value="Other">Other</option>
                                                <option value="Holiday">Holiday</option>
                                                <option value="Excused Absence">Excused Absence</option>
                                                <option value="Mistake">Mistake</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-3">
                                        <input name="add_subtract_hours" type="submit" class="btn green" value="Submit">
                                    </div>
                                </div>

                            </form>


                            <!-- END FORM-->
                        </div>
                    </div>
                    <div class="portlet box yellow-gold">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-plus"></i>Add Day to All Active Students
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="in expand"> </a>

                            </div>
                        </div>
                        <div class="portlet-body form" style="display: none!important;">

                            <!-- BEGIN FORM-->
                            <form action="" method="post" class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Select Date</label>
                                    <div class="col-md-3">
                                        <div class="input-group input-medium date date-picker" style="width: 100%;"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input type="text" class="form-control" style="width: 100%;"
                                                   name="date_selected" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Reason (Optional)</label>
                                    <div class="col-md-4">
                                        <select name="reason" class="bs-select form-control">
                                            <option value="Other">Other</option>
                                            <option value="Holiday">Holiday</option>
                                            <option value="Excused Absence">Excused Absence</option>
                                            <option value="Mistake">Mistake</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-3">
                                        <input name="add_day_all" type="submit" class="btn yellow-gold" value="Submit">
                                    </div>
                                </div>

                            </form>


                            <!-- END FORM-->
                        </div>
                    </div>
                    <div class="portlet box red-haze">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-minus"></i>Subtract Day from All Active Students
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="in expand"> </a>

                            </div>
                        </div>
                        <div class="portlet-body form" style="display: none!important;">

                            <!-- BEGIN FORM-->
                            <form action="" method="post" class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Select Date</label>
                                    <div class="col-md-3">
                                        <div class="input-group input-medium date date-picker" style="width: 100%;"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input type="text" class="form-control" style="width: 100%;"
                                                   name="date_selected" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Reason (Optional)</label>
                                    <div class="col-md-4">
                                        <select name="reason" class="bs-select form-control">
                                            <option value="Other">Other</option>
                                            <option value="Holiday">Holiday</option>
                                            <option value="Excused Absence">Excused Absence</option>
                                            <option value="Mistake">Mistake</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-3">
                                        <input name="sub_day_all" type="submit" class="btn red-haze" value="Submit">
                                    </div>
                                </div>

                            </form>


                            <!-- END FORM-->
                        </div>
                    </div>
                    <div class="portlet box grey-gallery">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bomb"></i>Reset Hour Corrections of ALL students.
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="in expand"> </a>

                            </div>
                        </div>
                        <div class="portlet-body form" style="display: none!important;">

                            <!-- BEGIN FORM-->
                            <form action="" method="post" class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Important!</label>
                                    <div class="col-md-4">

                                        <p>Click the below button to reset ALL hour corrections of each student. This
                                            will reset all hours added/subtracted due to holidays, excused absences etc.
                                            and is PERMANENT.</p>
                                        <p>This tool is meant to be used after a semester/session/term is over, but can
                                            be used at any point.</p>

                                        <!-- /input-group -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-3">
                                        <input name="reset_hour_corrections" type="submit" class="btn  grey-gallery"
                                               value="RESET"
                                               onclick="return confirm('Are you sure you want to reset hour corrections for ALL students?');">
                                    </div>
                                </div>

                            </form>


                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- <div class="portlet box blue-hoki">
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
                                             <input name="find_date_cumulative" type="submit" class="btn blue-hoki" value="Submit">
                                         </div>
                                     </div>
                                 </div>

                             </form>


                         </div>
                     </div>-->
                    <div class="portlet box yellow">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-info-circle"></i>Information On Cumulative View
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="in expand"> </a>

                            </div>
                        </div>
                        <div id="cumulative_info" class="portlet-body form" style="display: none!important; ">

                            <!-- BEGIN FORM-->
                            <p><b>Some basic information about how cumulative hours are calculated:</b></p>
                            <p><b>Hours Worked:</b> Sum of all hours that the student has worked (hours that have been
                                documented) in the chosen period.</p>
                            <p><b>Scheduled Hours:</b> Sum of all hours that the student should have worked in the
                                chosen period, based on his individual weekly schedule. Hours of each day are added from
                                start of the chosen period till the end.</p>
                            <p><b>Hours Correction:</b> How many hours have been added/subtracted due to holidays,
                                excused absences or other reasons.</p>
                            <p><b>(+/- Indicator) = (Hours Worked) - (Scheduled Hours) + (Hours Correction) </b> <br>The
                                "Edit Plus/Minus Indicator" tool is used to add or subtract hours from the +/- indicator
                                of each student. This tool is needed in the case of a holiday, or when the
                                Semester/Term/Session starts in the middle of the week, or student is otherwise has an
                                excused absence. This does <span style="color:red; font-weight: 500;">NOT</span> add
                                hours to the student but just modifies the "+/-" indicator. </p>


                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                    <?php
                }

                ?>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->

    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <?php include '../sections/quicksidebar.php' ?>
    <!-- END QUICK SIDEBAR -->

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