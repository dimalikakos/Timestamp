<?php
include '../db.php';

if(isset($_POST['edit_student_schedule'])){
    $errMsg = '';
    $message = '';
    $try_student_id = trim($_POST['select_student_id_for_edit_schedule']);

    $monday = trim($_POST['monday_hours_edit']);
    $tuesday = trim($_POST['tuesday_hours_edit']);
    $wednesday = trim($_POST['wednesday_hours_edit']);
    $thursday = trim($_POST['thursday_hours_edit']);
    $friday = trim($_POST['friday_hours_edit']);

    $period_id = trim($_POST['edit_student_period_id']);


    $total = time_to_seconds($monday)+time_to_seconds($tuesday)+time_to_seconds($wednesday)+time_to_seconds($thursday)+time_to_seconds($friday);


    if ($total > time_to_seconds("15:00:00")) {
        $errMsg = "Weekly Hours over 15 (" . seconds_to_hours($total) . ").<br>";
    }

    if ($period_id == "" ){
        $errMsg .= 'Please select period for student.<br>';
    }

    if(strlen($try_student_id) != 6 || !is_numeric($try_student_id)) {
        $errMsg .= 'Please select valid student id.<br>';
    }

    if ($errMsg == ''){
        update_student_period($try_student_id,$period_id);
        $message2 = update_student_schedule($try_student_id,$monday,$tuesday,$wednesday,$thursday,$friday);
        header("location: add_student_db.php?message=".$message2);
    }else{
        header("location: add_student_db.php?error=".$errMsg);
    }
}
?>