<?php
include '../db.php';
session_start();

if(isset($_POST['add_subtract_hours'])){
    $errMsg = '';
    $message = '';
    $try_student_id = $_POST['select_student_id_for_alteration'];
    $try_add_altered_hours = trim($_POST['add_altered_hours']);
    $try_sub_altered_hours = trim($_POST['sub_altered_hours']);
    $try_reason = $_POST['reason'];

    if ($try_add_altered_hours == "none" && $try_sub_altered_hours == "none"){
        $errMsg .= 'Please select valid time for Plus/Minus Indicator.<br>';
        header("location: ".$_SERVER['REQUEST_URI']."&error=".$errMsg."&success=".$message);
    }

    if ($try_add_altered_hours != "none" && $try_sub_altered_hours != "none"){
        $errMsg .= 'Please select either add, OR subtract for Plus/Minus Indicator , not both.<br>';
        header("location: ".$_SERVER['REQUEST_URI']."&error=".$errMsg."&success=".$message);
    }

    if ($try_student_id == ''){
        $errMsg .= 'Please select valid student for Plus/Minus Indicator.<br>';
        header("location: ".$_SERVER['REQUEST_URI']."&error=".$errMsg."&success=".$message);
    }
    if($errMsg == ''){
        if($try_add_altered_hours != "none"){
            $action = 'added';
            $try_altered_hours = $try_add_altered_hours;

        }else{
            $action = 'subtracted';
            $try_altered_hours = $try_sub_altered_hours;
        }
        $history = add_history_indicator($_SESSION['currentUserID'],$try_student_id,$action,$try_altered_hours,$try_reason);
        $message = alter_plus_minus($try_student_id,$try_altered_hours,$action);
        header("location: ".$_SERVER['REQUEST_URI']."&error=".$errMsg."&success=".$message);
    }
}
if(isset($_POST['add_day_all'])){
    $date_selected = $_POST['date_selected'];
    $try_reason = $_POST['reason'];
    if ($date_selected != "" && $date_selected != "sat" && $date_selected != "sun" ) {
        $day = date('l', strtotime($date_selected));
        $day = substr(strtolower($day), 0, 3);
        alter_all_active_students($day,'added');
        $history = add_history_indicator($_SESSION['currentUserID'],"All","added",$day,$try_reason);
        header("location: " . $_SERVER['REQUEST_URI'] . "&error=&success=");
    }else {
        $errMsg = "Please select weekday for 'Add Day to All' tool.";
        header("location: ".$_SERVER['REQUEST_URI']."&error=".$errMsg."&success=");
    }
}

if(isset($_POST['sub_day_all'])){
    $date_selected = $_POST['date_selected'];
    $try_reason = $_POST['reason'];
    if ($date_selected != "" && $date_selected != "sat" && $date_selected != "sun" ) {
        $day = date('l', strtotime($date_selected));
        $day = substr(strtolower($day), 0, 3);
        alter_all_active_students($day,'subtracted');
        $history = add_history_indicator($_SESSION['currentUserID'],"All",'subtracted',$day,$try_reason);
        header("location: " . $_SERVER['REQUEST_URI'] . "&error=&success=");
    }else {
        $errMsg = "Please select weekday for 'Add Day to All' tool.";
        header("location: ".$_SERVER['REQUEST_URI']."&error=".$errMsg."&success=");
    }
}

if(isset($_POST['reset_hour_corrections'])){
    reset_hour_corrections();
    $history = add_history_indicator($_SESSION['currentUserID'],'All',"Reset",'All',"Reset");
}