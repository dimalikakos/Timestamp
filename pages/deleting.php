<?php
session_start();
include '../db.php';
include_once '../db_functions.php';

$work_log = $_GET['delete_log'];
$date_page = $_GET['date_page'];
$student_id_worked = $_GET['student_worked'];


delete_work_log(intval($work_log));
add_to_history($work_log,$_SESSION['currentUserID'],$student_id_worked,"deleted",$date_page,"Deleted work log #".$work_log.".");
header("location: ../pages/single.php?date_page=".$date_page);