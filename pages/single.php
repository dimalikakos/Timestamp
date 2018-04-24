<?php
include '../db.php';
include_once '../db_functions.php';
include '../pages/find_date_script.php';
session_start();
$date_page = $_GET['date_page'];

$old_date = date('l, F d Y ',strtotime($date_page));
$old_date_timestamp = strtotime($old_date);
$date_formatted = date('l, F d, Y', $old_date_timestamp);
$date_formatted_for_DB = date('Y-m-d', $old_date_timestamp);

if(isset($_GET['invalid_time'])){
    $errMsg .= "Invalid time input: Either end-time is before start-time or time input is not between 8:00 am and 9:00 pm.<br>";
}
$active_students = get_students_based_on_status("Y");
$inactive_students = get_students_based_on_status("N");
include 'add_new_student.php'; // Includes Login Script


if ($_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'sa') {
    if($_SESSION['account_type'] == 'sa' && $date_page != date("d-m-Y")){
        header("location: /pages/single.php?date_page=".date("d-m-Y"));
    }

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
        <title><?php echo $date_formatted ?> | Timestamp</title>
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
                            <span>Day Page</span>
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
                <h3 class="page-title">Day Page
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->

                        <div class="portlet light portlet-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    Viewing For Date:
                                    <span
                                        class="caption-subject font-blue sbold uppercase"> <?php echo $date_formatted; ?> </span>
                                </div>
                            </div>
                            <div class="portlet-title" style="">
                                <div class="caption">

                                    <?php
                                    echo "<span style='color : red;'>" . $errMsg . "</span>";
                                    $errMsg = '';
                                    ?>
                                </div>
                            </div>
                            <?php
                            if ($_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'se') {
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-calendar"></i>View Another Date
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
                                                    <label class="control-label col-md-3">Select Date</label>
                                                    <div class="col-md-3">
                                                        <div class="input-group input-medium date date-picker"
                                                             style="width: 100%;" data-date-format="dd-mm-yyyy"
                                                             data-date-viewmode="years">
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
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="col-md-3">
                                                        <input name="find_date" type="submit" class="btn blue"
                                                               value="Submit">
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
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-plus"></i>Add New Student
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
                                                <label class="control-label col-md-3">Student Name</label>
                                                <div class="col-md-3">
                                                    <select id="single" class="form-control select2"
                                                            name="select_student_id">
                                                        <option></option>
                                                        <?php
                                                        echo "<optgroup label='Active'>";
                                                        foreach ($active_students as $active_student) {
                                                            echo "<option value=' " . $active_student['student_id'] . " '>" . $active_student['first_name'] . " " . $active_student['last_name'] . " - " . $active_student['student_id'] . "</option>";
                                                        }
                                                        echo "</optgroup>";
                                                        echo "<optgroup label=\"Inactive\">";

                                                        foreach ($inactive_students as $inactive_student) {
                                                            echo "<option value='AK' disabled=\"disabled\">" . $inactive_student['first_name'] . " " . $inactive_student['last_name'] . " - " . $inactive_student['student_id'] . "</option>";
                                                        }
                                                        echo "</optgroup>";
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Start Time (24 hour
                                                    format)</label>

                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <input type="text" name="start_time"
                                                               class="form-control timepicker timepicker-24">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-clock-o"></i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input name="date_student_worked" type="text" style="display: none;"
                                                       value="<?php echo $date_formatted_for_DB ?>">
                                                <label class="control-label col-md-3"></label>
                                                <div class="col-md-3">

                                                    <input name="send_id" type="submit" class="btn green" value="Submit">
                                                    <input name="use_current_time" type="submit" class="btn green" value="Use Current Time">

                                                </div>
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
                                        <th style="display: none" >Date</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Work Log ID</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Edit</th>
                                        <th>Delete</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $get_all_work_hours = get_all_work_hours_date($date_formatted_for_DB);
                                    foreach ($get_all_work_hours as $work_hour_log) {
                                        $student_info = get_student_info($work_hour_log['student_id']);
                                        echo "<tr>";
                                        echo "<td style=\"display: none\" >" . $date_formatted_for_DB . "</td>";
                                        echo "<td>" . $student_info[0]['last_name'] . " " . $student_info[0]['first_name'] . "</td>";
                                        echo "<td>" . $work_hour_log['student_id'] . "</td>";
                                        echo "<td>" . $work_hour_log['id'] . "</td>";
                                        echo "<td>" . $work_hour_log['start_time'] . "</td>";
                                        echo "<td>" . $work_hour_log['end_time'] . "</td>";
                                        echo "<td>
                                        <a class=\"edit\" href=\"javascript:;\"> Edit </a>
                                    </td>
                                    <td>
                                        <a class=\"delete\" href=\"javascript:;\"> Delete </a>
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
    <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
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