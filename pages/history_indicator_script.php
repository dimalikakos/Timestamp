<?php
if(isset($_POST['find_date_history_indicator'])){
    $indicator_history_from = $_POST['indicator_history_from'];
    $indicator_history_to = $_POST['indicator_history_to'];
    if ($indicator_history_from != '' && $indicator_history_to != '') {
        header("location: /pages/history_indicator.php?history_from=".$indicator_history_from."&history_to=".$indicator_history_to);
    }else{
        header("location: ".$_SERVER['REQUEST_URI']."&error=&success=");
    }
}

if(isset($_POST['delete_history_period_indicator'])){
    $active_period = get_active_period();
    $delete_history_from = $_POST['delete_history_from'];
    $delete_history_to = $_POST['delete_history_to'];
    if ($delete_history_from != '' && $delete_history_to != '') {
        delete_history_indicator_period($delete_history_from, $delete_history_to);
        header("location: /pages/history_indicator.php?history_from=".$active_period['start_date']."&history_to=" . $active_period['end_date']);
    }else{
        header("location: ".$_SERVER['REQUEST_URI']."&error=&success=");
    }


}