<?php
session_start();
include '../db.php';
include_once '../db_functions.php';

$mon = $_GET['mon'];
$tue = $_GET['tue'];
$wed = $_GET['wed'];
$thu = $_GET['thu'];
$fri = $_GET['fri'];

$student_id = $_GET['student_id'];

$total = time_to_seconds($mon)+time_to_seconds($tue)+time_to_seconds($wed)+time_to_seconds($thu)+time_to_seconds($fri);


if ($total > time_to_seconds("15:00:00")){
    $errMsg="Weekly Hours over 15 (".seconds_to_hours($total)."). Please edit more carefully, or contact admin for change of maximum weekly hours.";
    header("location: add_student_db.php?error=".$errMsg);
} else {
    $message = update_student_schedule($student_id,$mon,$tue,$wed,$thu,$fri);
    header("location: add_student_db.php?message=".$message);
}