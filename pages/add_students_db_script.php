<?php
include '../db.php';

if(isset($_POST['new_student'])){
    $errMsg = '';
    $message = '';
    $try_student_first_name = trim($_POST['new_student_first_name']);
    $try_student_last_name = trim($_POST['new_student_last_name']);
    $try_student_id = trim($_POST['new_student_id']);
    $period_id = trim($_POST['student_period_id']);

    $monday = trim($_POST['monday_hours']);
    $tuesday = trim($_POST['tuesday_hours']);
    $wednesday = trim($_POST['wednesday_hours']);
    $thursday = trim($_POST['thursday_hours']);
    $friday = trim($_POST['friday_hours']);

    $total = time_to_seconds($monday)+time_to_seconds($tuesday)+time_to_seconds($wednesday)+time_to_seconds($thursday)+time_to_seconds($friday);

    if ($total > time_to_seconds("15:00:00")) {
        $errMsg = "Weekly Hours over 15 (" . seconds_to_hours($total) . ").<br>";
    }

    if (strlen($try_student_first_name)<2 || strlen($try_student_last_name)<2 ){
        $errMsg .= 'First name AND last name must be over 1 characters long.<br>';
    }

    if ($period_id == "" ){
        $errMsg .= 'Please select period for student edit.<br>';
    }

    if(strlen($try_student_id) != 6 || !is_numeric($try_student_id)) {
        $errMsg .= 'Please select valid student id.<br>';
    } else{
        $student_info = get_student_info($try_student_id);
        if (strlen($student_info[0]['first_name'])>0){
            $errMsg .= 'Student ID:'.$try_student_id.' already exists in DB ('.$student_info[0]['first_name'].' '.$student_info[0]['last_name'] .').<br>';
        }
    }
    if ($errMsg == ''){
        $message = add_new_student_to_db($try_student_first_name,$try_student_last_name,$try_student_id,$period_id);
        $message2 = add_new_student_work_schedule($try_student_id,$monday,$tuesday,$wednesday,$thursday,$friday);
        header("location: add_student_db.php?message=".$message);
    }else{
        header("location: add_student_db.php?error=".$errMsg);
    }
}
?>