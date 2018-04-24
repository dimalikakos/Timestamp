<?php
include '../db.php';

if(isset($_POST['edit_student_name'])){
    $errMsg = '';
    $message = '';
    $try_student_id = $_POST['select_student_id_for_edit_name'];
    $try_student_first_name = trim($_POST['edit_student_first_name']);
    $try_student_last_name = trim($_POST['edit_student_last_name']);


    if (strlen($try_student_first_name)<2 || strlen($try_student_last_name)<2 ){
        $errMsg .= 'First name AND last name must be over 1 characters long.<br>';
    }

    if ($errMsg == ''){
        $message = edit_student_name($try_student_first_name,$try_student_last_name,$try_student_id);
        header("location: add_student_db.php?message=".$message);
    }else{
        header("location: add_student_db.php?error=".$errMsg);
    }



}