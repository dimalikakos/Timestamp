<?php
session_start();
include '../db.php';
include_once '../db_functions.php';

$error_boolean = false;

$save_start_time = $_GET['save_start_time'];
$save_end_time = $_GET['save_end_time'];

echo $save_start_time."<br>";
echo $save_end_time."<br>";


$date_worked = $_GET['date_worked'];
$student_log = $_GET['save_log'];

$student_id_worked = $_GET['student_id_worked'];


$current_work_log = get_work_log($student_log);


if(strtotime($save_start_time) >= strtotime($save_end_time)){
    $error_boolean = true;
}
if(strtotime($save_start_time) > strtotime("21:00:00") || strtotime($save_start_time) < strtotime("09:00:00")  ){
    $error_boolean = true;
    echo "ERROR START";
}
if(strtotime($save_end_time) > strtotime("21:00:00") || strtotime($save_end_time) < strtotime("09:00:00")  ){
    $error_boolean = true;
    echo "ERROR END";
}

if (!$error_boolean){
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
            $what_happened .= "Changed end time from: " . $current_work_log['end_time'] . " to " . $save_end_time . ".\n";
        }else {
            $what_happened .= "Entered end time as: " . $save_end_time . ".\n";
        }
    }

    update_current_student_log($student_log, $save_start_time, $save_end_time,$date_worked);
    add_to_history($student_log,$_SESSION['currentUserID'],$student_id_worked,"saved",$date_worked,$what_happened);
    header("location: ../pages/single.php?date_page=".$date_worked);
}else{
    header("location: ../pages/single.php?invalid_time=Y&date_page=".$date_worked);
}

?>



