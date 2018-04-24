<?php
include '../db.php';

if(isset($_POST['send_id'])){
    $errMsg = '';
    $try_student_id = trim($_POST['select_student_id']);
    $try_start_time = strtotime($_POST['start_time']);
    $just_hour = (Int)(date('H',$try_start_time));
    $try_start_time = date('H:i:s',$try_start_time);
    $date_worked = $_POST['date_student_worked'];


    if(strlen($try_student_id) != 6)
        $errMsg .= 'Please select valid student.<br>';

    if($just_hour >=21 || $just_hour < 8 ) {
       $errMsg .= 'Invalid Hour. Please enter an hour between 8:00 AM and 9:00 PM.<br>';

    }
    if($errMsg == '') {
        $message = add_new_student_work_log($try_student_id,$try_start_time,$date_worked);

        header("location: single.php?date_page=".$date_worked);



    }
}
if(isset($_POST['use_current_time'])){
    $errMsg = '';
    $try_student_id = trim($_POST['select_student_id']);
    $try_start_time = strtotime(date("H:i"));
    $just_hour = (Int)(date('H',$try_start_time));
    $try_start_time = date('H:i:s',$try_start_time);
    $date_worked = $_POST['date_student_worked'];


    if(strlen($try_student_id) != 6)
        $errMsg .= 'Please select valid student.<br>';

    if($just_hour >=21 || $just_hour < 8 ) {
        $errMsg .= 'Invalid Hour. Please enter an hour between 8:00 AM and 9:00 PM.<br>';

    }
    if($errMsg == '') {
        $message = add_new_student_work_log($try_student_id,$try_start_time,$date_worked);

        header("location: single.php?date_page=".$date_worked);



    }
}

