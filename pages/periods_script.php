<?php
include '../db.php';

if(isset($_POST['add_new_period'])){
    $errMsg = '';
    $message = '';
    $try_period_start = trim($_POST['period_date_range_from']);
    $try_period_end = trim($_POST['period_date_range_to']);
    $try_period_name = trim($_POST['period_name']);

    if (strlen($try_period_name)<5){
        $errMsg .= 'Term/Session/Semester name must be over 3 characters long.<br>';
    }

    if (strlen($try_period_start) == 0 || strlen($try_period_end) == 0 ){
        $errMsg .= 'Please enter valid start and end time.<br>';
    }

    if ($errMsg == ''){
        $message = add_new_period($try_period_name,$try_period_start,$try_period_end);
        header("location: periods.php?message=".$message);
    }else{
        header("location: periods.php?error=".$errMsg);
    }
}

if(isset($_POST['edit_period_range'])){
    $errMsg = '';
    $message = '';
    $try_period_start = trim($_POST['edit_period_date_range_from']);
    $try_period_end = trim($_POST['edit_period_date_range_to']);
    $try_period_id = trim($_POST['select_period_id_for_edit']);

    if (strlen($try_period_start) == 0 || strlen($try_period_end) == 0 ){
        $errMsg .= 'Please enter valid start and end time.<br>';
    }

    if (strlen($try_period_id) == 0 ){
        $errMsg .= 'Please select valid period.<br>';
    }

    if ($errMsg == ''){
        $message = edit_period_date_range($try_period_id,$try_period_start,$try_period_end);
        header("location: periods.php?message=".$message);
    }else{
        header("location: periods.php?error=".$errMsg);
    }
}

if(isset($_POST['select_current_period'])){
    $errMsg = '';
    $message = '';
    $try_period_id = trim($_POST['select_period_id']);

    if (strlen($try_period_id) == 0 ){
        $errMsg .= 'Please select valid period.<br>';
    }

    if ($errMsg == ''){
        $message = select_current_period($try_period_id);
        header("location: periods.php?message=".$message);
    }else{
        header("location: periods.php?error=".$errMsg);
    }
}

if(isset($_POST['select_current_period_for_deletion'])){
    $errMsg = '';
    $message = '';
    $try_period_id = trim($_POST['select_period_id_for_deletion']);

    if (strlen($try_period_id) == 0 ){
        $errMsg .= 'Please select valid period.<br>';
    }

    if ($errMsg == ''){
        $message = delete_period($try_period_id);
        header("location: periods.php?message=".$message);
    }else{
        header("location: periods.php?error=".$errMsg);
    }
}
?>