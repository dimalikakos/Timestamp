<?php
session_start();
include '../db.php';
include_once '../db_functions.php';
/*STRING TO TIME*/
$save_start_time = $_GET['save_start_time'];
$save_start_time_formatted = strtotime(date('H:i:s',strtotime($save_start_time)));
$save_end_time = $_GET['save_end_time'];
$save_end_time_formatted = strtotime(date('H:i:s',strtotime($save_end_time)));

$date_worked = $_GET['date_worked'];
/*GET LOG NUMBER (ID) */
$student_log = $_GET['save_log'];

$student_id_worked = $_GET['student_id_worked'];

/*GETTING DATA FROM DATABASE TO COMPARE*/
$current_work_log = get_work_log($student_log);
$save_time_start_hour = (Int)date('H',$save_start_time_formatted);
$save_time_end_hour = (Int)date('H',$save_end_time_formatted);


if ($save_time_end_hour  > $save_time_start_hour && $save_time_end_hour  > 7 && $save_time_end_hour  < 21
    && $save_time_start_hour > 7 && $save_time_start_hour < 21 ) {

    if ($current_work_log['start_time'] == $save_start_time) {
        $what_happened .= "Start time remained the same.";
    } else {
        // enter what it does if save start time is different
        $what_happened .= "Changed start time from: ".$current_work_log['start_time']." to ".$save_start_time.".\n";
    }

    if ($current_work_log['end_time'] == $save_end_time) {
        $what_happened .= "End time remained the same.";
    } else {
        if ($current_work_log['end_time'] != NULL) {
            $what_happened .= "Changed end time from: " . $current_work_log['end_time'] . " to " . $save_end_time . ". \n";
        }else {
            $what_happened .= "Entered end time as: " . $save_end_time . ". \n";
        }
    }

    update_current_student_log($student_log, $save_start_time, $save_end_time,$date_worked);
    add_to_history($student_log,$_SESSION['currentUserID'],$student_id_worked,"saved",$date_worked,$what_happened);
    header("location: ../pages/single.php?date_page=".$date_worked);
//WHAT HAPPENS BELOW IS TERRIBLE AND NEEDS FIXING. OMG DONT HAVE TIME NOW.
}else if((Int)date('H',$save_end_time_formatted) == (Int)date('H',$save_start_time_formatted) && (Int)date('i',$save_end_time_formatted) > (Int)date('i',$save_start_time_formatted) ){
    if ($current_work_log['start_time'] == $save_start_time) {

        $what_happened .= "Start time remained the same.";
    } else {
        // enter what it does if save start time is different
        $what_happened .= "Changed start time from: ".$current_work_log['start_time']." to ".$save_start_time.". \n";
    }

    if ($current_work_log['end_time'] == $save_end_time) {

        $what_happened .= "End time remained the same.";
    } else {

        // enter what happenes if save end time is different
        if ($current_work_log['end_time'] != NULL) {
            $what_happened .= "Changed end time from: " . $current_work_log['end_time'] . " to " . $save_end_time . ". \n";
        }else {
            $what_happened .= "Entered end time as: " . $save_end_time . ".\n";
        }

    }
    update_current_student_log($student_log, $save_start_time, $save_end_time,$date_worked);
    add_to_history($student_log, $_SESSION['currentUserID'],$student_id_worked,"saved",$date_worked,$what_happened);
    header("location: ../pages/single.php?date_page=".$date_worked);
}else {
    header("location: ../pages/single.php?invalid_time=Y&date_page=".$date_worked);
}


?>



