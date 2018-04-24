<?php
include $_SERVER['DOCUMENT_ROOT'].'/db.php';

if(isset($_POST['find_student_logs'])){
    $errMsg = '';
    $try_student_id = trim($_POST['select_student_id']);
    $student_data_range_from = $_POST['student_date_range_from'];
    $student_data_range_to = $_POST['student_date_range_to'];
    if ($student_data_range_from != '' && $student_data_range_to != '' && $try_student_id != '') {
        header("location: /pages/student_work_hours.php?student_date_range_from=" . $student_data_range_from . "&student_date_range_to=" . $student_data_range_to .
            "&student_id=" . $try_student_id);
    }


}
if(isset($_POST['current_period_work_logs'])){
    $active_period = get_active_period();
    $try_student_id = trim($_POST['current_period_work_logs_student']);
    if ($try_student_id != '') {
        header("location: /pages/student_work_hours.php?student_date_range_from=" . $active_period['start_date'] . "&student_date_range_to=" . $active_period['end_date'] .
            "&student_id=" . $try_student_id);
    }


}
