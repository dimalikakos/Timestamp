<?php
include '../db.php';
include_once '../db_functions.php';
include 'history_indicator_script.php';
session_start();

$history_from = $_GET['history_from'];
$history_to = $_GET['history_to'];


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
        <title> History Plus/Minus Indicator | Timestamp</title>
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

                <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="../index.php">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>View Student Hours</span>
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
                <h3 class="page-title">Plus/Minus Indicator History for Current Period (<span style="color: red; font-weight: bolder;"><?php echo date('l, F d, Y', strtotime($history_from))."</span> to <span style=\"color: red; font-weight: bolder;\">".date('l, F d, Y', strtotime($history_to)); ?></span>)
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->

                        <div class="portlet light portlet-fit bordered" >


                            <!-- END PORTLET-->
                        </div>
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
                                                <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control" name="indicator_history_from">
                                                    <span class="input-group-addon"> to </span>
                                                    <input type="text" class="form-control" name="indicator_history_to">
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-3">
                                                <input name="find_date_history_indicator" type="submit" class="btn blue-hoki" value="Submit">
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                <!-- END FORM-->
                            </div>
                        </div>
                        <?php

                        ?>
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>+/- History
                                </div>
                                <div class="tools"></div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Event</th>
                                        <th>Amount</th>
                                        <th>Reason</th>
                                        <th>Timestamp</th>




                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $history_to = $history_to." 23:59:59";
                                    $history = get_history_indicator_in_period($history_from,$history_to);
                                    foreach ($history as $historical_event) {
                                        echo "<tr>";
                                        $user_info = get_user_info($historical_event['user_id']);
                                        echo "<td>" . $user_info['first_name'] . " ". $user_info['last_name']. "</td>";
                                        if ($historical_event['student_id'] != 'All'){
                                            $student_info = get_student_info($historical_event['student_id']);
                                            $fullname =  $student_info[0]['first_name'] . " ". $student_info[0]['last_name'];
                                        }else {
                                            $fullname = 'All Active';
                                        }

                                        echo "<td>" . $fullname. "</td>";
                                        echo "<td>" . $historical_event['student_id'] . "</td>";
                                        echo "<td>". $historical_event['event'] . "</td>";
                                        if (strlen($historical_event['amount']) != 3){
                                            $amount = seconds_to_hours($historical_event['amount']);
                                        }else{
                                            $amount = "<span style='text-transform: capitalize'>".$historical_event['amount']."</span>";
                                        }
                                        echo "<td>". $amount . "</td>";
                                        echo "<td>". $historical_event['reason'] . "</td>";
                                        echo "<td>". $historical_event['history_timestamp'] . "</td>";


                                    }
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
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

                                                    Deletion is permanent. Start and End date history will also be deleted. Please backup
                                                    any data before deleting.
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
                                                    <input name="delete_history_period_indicator" type="submit" class="btn red-pink"
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