<?php
include '../db.php';

if(isset($_POST['edit_status'])){
    $errMsg = '';
    $message = '';
    $try_student_id = $_POST['select_student_id_for_edit_status'];
    $try_new_status = $_POST['change_status'];


    if ($try_student_id == ''){
        $errMsg .= 'Please select valid student ID to change his/her status. <br>';
        header("location: add_student_db.php?error=".$errMsg);
    }else {
        $message = edit_student_status($try_student_id,$try_new_status);
        header("location: add_student_db.php?message=".$message);
    }



}