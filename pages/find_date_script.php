<?php
if(isset($_POST['find_date'])){

    $date_selected = $_POST['date_selected'];
    if ($date_selected != '') {
        header("location: /pages/single.php?date_page=" . $date_selected);
    }
}
if(isset($_POST['find_date_cumulative'])){
    $cumulative_from = $_POST['cumulative_from'];
    $cumulative_to = $_POST['cumulative_to'];
    if ($cumulative_from != '' && $cumulative_to != '') {
        header("location: /pages/cumulative.php?cumulative_from=" . $cumulative_from . "&cumulative_to=" . $cumulative_to);
    }else{
        header("location: ".$_SERVER['REQUEST_URI']."&error=&success=");
    }
}
if(isset($_POST['todays_date'])){
    $date_selected = date("d-m-Y");
    header("location: /pages/single.php?date_page=".$date_selected);
}
if(isset($_POST['find_date_history'])){
    $history_from = $_POST['history_from'];
    $history_to = $_POST['history_to'];
    if ($history_from != '' && $history_to != '') {
        header("location: /pages/history.php?history_from=" . $history_from . "&history_to=" . $history_to);
    }else{
        header("location: ".$_SERVER['REQUEST_URI']."&error=&success=");
    }
}
if(isset($_POST['delete_history'])){
    $active_period = get_active_period();
    $delete_history_from = $_POST['delete_history_from'];
    $delete_history_to = $_POST['delete_history_to'];
    if ($delete_history_from != '' && $delete_history_to != '') {
        delete_history_period($delete_history_from, $delete_history_to);
        header("location: /pages/history.php?history_from=".$active_period['start_date']."&history_to=" . $active_period['end_date']);
    }else{
        header("location: ".$_SERVER['REQUEST_URI']."&error=&success=");
    }
}
if(isset($_POST['change_period'])){
    $period_id = $_POST['selected_period_for_cumulative'];
    if ($period_id != ''){
        $selected_period_info = get_period_by_id($period_id);
        $period_start = $selected_period_info['start_date'];
        if ($selected_period_info['end_date']>date("d-m-Y")){
            $period_end = date("d-m-Y");

        }else{
            $period_end = $selected_period_info['end_date'];
        }
        header("location: /pages/cumulative.php?cumulative_from=".$period_start."&cumulative_to=".$period_end."&period_id=".$period_id);
    }else{
        header("location: ".$_SERVER['REQUEST_URI']."&error=&success=");
    }
}