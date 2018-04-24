<?php
date_default_timezone_set('Europe/Athens');
function get_all_students () {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->query ("SELECT first_name, last_name, student_id,is_active,period
                                FROM students
                                ORDER BY id DESC");

    } catch (PDOException $e) {
        echo "error selecting student" . $e;

    }
    $student = $results->fetchAll (PDO::FETCH_ASSOC);
    return $student;
}


function get_all_work_logs_of_student_in_period ($student_id,$date_from,$date_to) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT student_id,date_worked,start_time,end_time,id
                                FROM work_hours
                                WHERE student_id = ? AND date_worked >= ? AND date_worked <= ?");
        $results->bindparam(1,$student_id);
        $results->bindparam(2,$date_from);
        $results->bindparam(3,$date_to);
        $results->execute();
        $logs = $results->fetchAll (PDO::FETCH_ASSOC);
        return $logs;

    } catch (PDOException $e) {
        echo "error selecting products" . $e;

    }
}




function get_all_work_hours_date($date) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT student_id,date_worked,start_time,end_time,id
                                FROM work_hours
                                WHERE date_worked = ?
                                ORDER BY id DESC");
        $results->bindparam(1,$date);
        $results->execute();
        $log = $results->fetchAll (PDO::FETCH_ASSOC);
        return $log;

    } catch (PDOException $e) {
        echo "error selecting products" . $e;

    }

}





function get_work_log_hours_of_student_in_period($student_id,$date_from,$date_to){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT start_time,end_time
                                FROM work_hours
                                WHERE student_id = ? AND date_worked >= ? AND date_worked <= ?");
        $results->bindparam(1,$student_id);
        $results->bindparam(2,$date_from);
        $results->bindparam(3,$date_to);
        $results->execute();
        $logs = $results->fetchAll (PDO::FETCH_ASSOC);
        $total_time = 0;
        foreach($logs as $log_time){
            if(strlen($log_time['end_time'])>0){
                $student_work_time = intval(strtotime($log_time['end_time']))- intval(strtotime($log_time['start_time']));
                $total_time = $student_work_time + $total_time;
            } // ENTER HERE CODE TO FIND INCOMPLETE WORK LOGS
        }
        return $total_time;
    } catch (PDOException $e) {
        echo "error selecting products" . $e;

    }
}

function add_new_student_work_log($student_id,$start_time,$date_worked){ //maybe add scheduled time of day etc.
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("INSERT INTO work_hours(student_id,start_time,date_worked)
                                 VALUES(?, ?, ?)");
        $results->bindparam(1, $student_id);
        $results->bindparam(2, $start_time);
        $results->bindparam(3, $date_worked);
        $results->execute();
        $message = "Student Added";
        $most_recent = get_most_recent_work_log($student_id);
        $what_happened = "Created work log #".$most_recent['id'].".";
        add_to_history($most_recent['id'],$_SESSION['currentUserID'],$student_id,"created",$date_worked,$what_happened);


    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = "Error adding student, please try again.";
    }
    return $message;
}

function get_most_recent_work_log($student_id){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT id
                                FROM work_hours
                                WHERE student_id = ?
                                ORDER BY id DESC ");
        $results->bindparam(1,$student_id);
        $results->execute();
        $logs = $results->fetchAll (PDO::FETCH_ASSOC);
        return $logs[0];

    } catch (PDOException $e) {
        echo "error selecting products" . $e;

    }

}

function update_current_student_log($student_log,$start_time,$end_time,$date_worked){
    require UC_ROOT.'/db.php';

    try {
        $results = $db->prepare ("UPDATE work_hours
                              SET start_time= ?, end_time = ?, date_worked = ?
                              WHERE id = ?");
        $results->bindparam(1,$start_time);
        $results->bindparam(2,$end_time);
        $results->bindparam(3,$date_worked);
        $results->bindparam(4,$student_log);
        $results->execute();
        $message = "update successfull.";

    } catch (PDOException $e) {
        echo "error updating student." . $e;
        $message = "ERROR";
    }
    return $message;
}
function get_work_log($log){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT  start_time,end_time
                                  FROM work_hours
                                  WHERE id = ?
                                  LIMIT 1");
        $results->bindparam(1,$log);
        $results->execute();
        $log = $results->fetch (PDO::FETCH_ASSOC);
        return $log;
    } catch (PDOException $e) {
        echo "error selecting finding student" . $e;
    }
}

function delete_work_log($log){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("DELETE FROM work_hours
                                 WHERE id = ?");
        $results->bindparam(1,$log);
        $results->execute();
        $message = 'SUCCESS: You have delted log: '.$log;

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = 'ERROR: You have not deleted log:'.$log;


    }
    return $message;
}


function get_student_info($student_id) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT  first_name,last_name
                                  FROM students
                                  WHERE student_id = ?");

        $results->bindparam(1,$student_id);
        $results->execute();
        $log = $results->fetchAll (PDO::FETCH_ASSOC);
        return $log;
    } catch (PDOException $e) {
        echo "error selecting finding student" . $e;

    }
}
function get_user_info($user_id) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT  first_name,last_name
                                  FROM users
                                  WHERE user_id = ?");

        $results->bindparam(1,$user_id);
        $results->execute();
        $user_info = $results->fetch (PDO::FETCH_ASSOC);
        return $user_info;
    } catch (PDOException $e) {
        echo "error selecting finding user info: " . $e;

    }
}
function get_students_based_on_status($active) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT  first_name,last_name,student_id,plus_minus
                                  FROM students
                                  WHERE is_active = ?");

        $results->bindparam(1,$active);
        $results->execute();
        $log = $results->fetchAll (PDO::FETCH_ASSOC);
        return $log;
    } catch (PDOException $e) {
        echo "error selecting finding student" . $e;

    }
}

function get_current_period_active_students($period) {
    require UC_ROOT.'/db.php';
    $active = 'Y';
    try {
        $results = $db->prepare ("SELECT  first_name,last_name,student_id,plus_minus
                                  FROM students
                                  WHERE is_active = ? AND period = ?");

        $results->bindparam(1,$active);
        $results->bindparam(2,$period);
        $results->execute();
        $log = $results->fetchAll (PDO::FETCH_ASSOC);
        return $log;
    } catch (PDOException $e) {
        echo "error selecting finding student" . $e;

    }
}

function add_new_student_to_db($first_name, $last_name, $student_id,$period_id){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("INSERT INTO students(first_name,last_name,student_id,period)
                                 VALUES(?, ?, ?, ?)");
        $results->bindparam(1, $first_name);
        $results->bindparam(2, $last_name);
        $results->bindparam(3, $student_id);
        $results->bindparam(4, $period_id);
        $results->execute();

        $message = "Student successfully added to the database.";

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = "Error adding student, please try again.";
    }
    return $message;
}


function update_student_period($student_id,$period_id){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("UPDATE students
                              SET period = ?
                              WHERE student_id = ?");
        $results->bindparam(1,$period_id);
        $results->bindparam(2,$student_id);
        $results->execute();
        $message = "Successfully updated ".$student_id."s period.";

    } catch (PDOException $e) {
        echo "error updating student's schedule: " . $e;
        $message = "Error updating student's schedule.";
    }
    return $message;
}


function add_new_student_work_schedule($student_id,$monday_hours,$tuesday_hours,$wednesday_hours,$thursday_hours,$friday_hours){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("INSERT INTO student_schedule(student_id,mon,tue,wed,thu,fri)
                                 VALUES(?, ?, ?, ?, ?, ?)");
        $results->bindparam(1, $student_id);
        $results->bindparam(2, $monday_hours);
        $results->bindparam(3, $tuesday_hours);
        $results->bindparam(4, $wednesday_hours);
        $results->bindparam(5, $thursday_hours);
        $results->bindparam(6, $friday_hours);
        $results->execute();

        $message = "Student schedule successfully added.";

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = "Error adding student schedule, please try again.";
    }
    return $message;
}



function get_student_schedule ($student_id) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT mon,tue,wed,thu,fri
                                FROM student_schedule
                                WHERE student_id = ?");
        $results->bindparam(1,$student_id);
        $results->execute();
        $schedule = $results->fetch (PDO::FETCH_ASSOC);
        return $schedule;
    } catch (PDOException $e) {
        echo "error finding student schedule" . $e;
        $schedule = '';
    }
    return $schedule;
}

function update_student_schedule($student_id,$mon,$tue,$wed,$thu,$fri){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("UPDATE student_schedule
                              SET mon= ?, tue = ?, wed = ?, thu = ?, fri = ?
                              WHERE student_id = ?");
        $results->bindparam(1,$mon);
        $results->bindparam(2,$tue);
        $results->bindparam(3,$wed);
        $results->bindparam(4,$thu);
        $results->bindparam(5,$fri);
        $results->bindparam(6,$student_id);
        $results->execute();
        $message = "Successfully updated ".$student_id."s schedule.";

    } catch (PDOException $e) {
        echo "error updating student's schedule: " . $e;
        $message = "Error updating student's schedule.";
    }
    return $message;
}


function edit_student_info($student_id,$new_status){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("UPDATE students
                              SET is_active = ?
                              WHERE student_id = ?");
        $results->bindparam(1,$new_status);
        $results->bindparam(2,$student_id);
        $results->execute();
        $message = "Successfully updated ".$student_id."s information.";

    } catch (PDOException $e) {
        echo "error updating student's information: " . $e;
        $message = "Error updating student's information.";
    }
    return $message;
}
function edit_student_status($student_id,$new_status){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("UPDATE students
                              SET is_active = ?
                              WHERE student_id = ?");
        $results->bindparam(1,$new_status);
        $results->bindparam(2,$student_id);
        $results->execute();
        $message = "Successfully updated ".$student_id."s information.";

    } catch (PDOException $e) {
        echo "error updating student's information: " . $e;
        $message = "Error updating student's information.";
    }
    return $message;
}
function edit_student_name($first_name,$last_name,$student_id){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("UPDATE students
                              SET first_name = ? , last_name = ?
                              WHERE student_id = ?");
        $results->bindparam(1,$first_name);
        $results->bindparam(2,$last_name);
        $results->bindparam(3,$student_id);
        $results->execute();
        $message = "Successfully updated ".$student_id."s information.";

    } catch (PDOException $e) {
        echo "error updating student's information: " . $e;
        $message = "Error updating student's information.";
    }
    return $message;
}
function add_to_history($log_id,$user_id,$student_id,$action_occurred,$date_page,$what_happened){
    require UC_ROOT.'/db.php';
    $current_timestamp = date('Y-m-d H:i:s', time());
    try {
        $results = $db->prepare("INSERT INTO history(log_id,user_id,student_id,action_occurred,date_page,history_timestamp,what_happened)
                                 VALUES(?, ?, ?, ?, ?, ?,?)");
        $results->bindparam(1, $log_id);
        $results->bindparam(2, $user_id);
        $results->bindparam(3, $student_id);
        $results->bindparam(4, $action_occurred);
        $results->bindparam(5, $date_page);
        $results->bindparam(6, $current_timestamp);
        $results->bindparam(7, $what_happened);
        $results->execute();

        $message = "History updated.";

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = "Error adding student, please try again.";
    }
    return $message;
}
function get_history_in_period($date_from,$date_to) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT id,log_id,user_id,student_id,action_occurred,date_page,history_timestamp,what_happened
                                FROM history
                                WHERE history_timestamp >= ? AND history_timestamp <= ?");
        $results->bindparam(1,$date_from);
        $results->bindparam(2,$date_to);
        $results->execute();
        $history = $results->fetchAll (PDO::FETCH_ASSOC);
        return $history;

    } catch (PDOException $e) {
        echo "error retrieving history." . $e;

    }
}
function delete_history_period($delete_history_from,$delete_history_to){
    $delete_history_from = $delete_history_from. " 00:00:00";
    $delete_history_to = $delete_history_to." 23:59:59";
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("DELETE FROM history
                                 WHERE history_timestamp >= ? AND history_timestamp <= ?");
        $results->bindparam(1,$delete_history_from);
        $results->bindparam(2,$delete_history_to);
        $results->execute();
        $message = 'SUCCESS: You have deleted period';

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = 'ERROR: You have not deleted';


    }
    return $message;
}
function get_plus_minus($student_id){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT plus_minus
                                FROM students
                                WHERE student_id = ?");
        $results->bindparam(1,$student_id);
        $results->execute();
        $plus_minus = $results->fetch (PDO::FETCH_ASSOC);
        return $plus_minus;

    } catch (PDOException $e) {
        echo "error updating plus/minus indicator." . $e;

    }

}
function alter_plus_minus($student_id,$alteration,$action){
    require UC_ROOT.'/db.php';
    $old_plus_minus = get_plus_minus($student_id);
    $old_plus_minus_seconds = $old_plus_minus['plus_minus'];
    $alteration = time_to_seconds($alteration);
    if ($action == 'added'){
        $alteration_string = ": Added +".seconds_to_hours($alteration)." hours.";
        $alteration =$old_plus_minus_seconds + $alteration ;
    }else{
        $alteration_string = ": Subtracted ".seconds_to_hours($alteration)." hours.";
        $alteration = $old_plus_minus_seconds - $alteration ;
    }

    try {
        $results = $db->prepare ("UPDATE students
                              SET plus_minus = ?
                              WHERE student_id = ?");
        $results->bindparam(1,$alteration);
        $results->bindparam(2,$student_id);
        $results->execute();

        $message = "Successfully updated ".$student_id."s information".$alteration_string;

    } catch (PDOException $e) {
        echo "error updating student's information: " . $e;
        $message = "Error updating student's information.";
    }
    return $message;
}

function alter_all_active_students($day,$action){
    require UC_ROOT.'/db.php';
    $active_students = get_students_based_on_status('Y');
    foreach ($active_students as $student) {
        $student_schedule = get_student_schedule($student['student_id']);
        $day_hours = $student_schedule[$day];
        alter_plus_minus($student['student_id'],$day_hours,$action);
    }
}

function reset_hour_corrections(){
    require UC_ROOT.'/db.php';
    $all_students = get_all_students();
    foreach ($all_students as $student) {
        $student_id = $student['student_id'];
        $zero = '0';
        try {
            $results = $db->prepare ("UPDATE students
                              SET plus_minus = ?
                              WHERE student_id = ?");
            $results->bindparam(1,$zero);
            $results->bindparam(2,$student_id);
            $results->execute();
        } catch (PDOException $e) {
            echo "error updating student's information: " . $e;
        }
    }
}



function add_history_indicator($user_id,$student_id,$event,$amount,$reason){
    require UC_ROOT.'/db.php';
    if (strlen($amount) != 3 ){
        $amount = time_to_seconds($amount);
    }
    $current_timestamp = date('Y-m-d H:i:s', time());
    try {
        $results = $db->prepare("INSERT INTO history_indicator(user_id,student_id,event,amount,reason,history_timestamp)
                                 VALUES(?, ?, ?, ?, ?, ?)");
        $results->bindparam(1, $user_id);
        $results->bindparam(2, $student_id);
        $results->bindparam(3, $event);
        $results->bindparam(4, $amount);
        $results->bindparam(5, $reason);
        $results->bindparam(6, $current_timestamp);
        $results->execute();


        $message = "Successfully updated history";

    } catch (PDOException $e) {
        echo "ERROR: " . $e;
        $message = "Error updating history." .$e;
    }
    return $message;
}

function get_history_indicator_in_period($date_from,$date_to) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT id,user_id,student_id,event,amount,reason,history_timestamp
                                FROM history_indicator
                                WHERE history_timestamp >= ? AND history_timestamp <= ?
                                ORDER BY history_timestamp DESC ");
        $results->bindparam(1,$date_from);
        $results->bindparam(2,$date_to);
        $results->execute();
        $history = $results->fetchAll (PDO::FETCH_ASSOC);
        return $history;

    } catch (PDOException $e) {
        echo "error retrieving history." . $e;

    }
}
function delete_history_indicator_period($delete_history_from,$delete_history_to){
    $delete_history_from = $delete_history_from. " 00:00:00";
    $delete_history_to = $delete_history_to." 23:59:59";
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("DELETE FROM history_indicator
                                 WHERE history_timestamp >= ? AND history_timestamp <= ?");
        $results->bindparam(1,$delete_history_from);
        $results->bindparam(2,$delete_history_to);
        $results->execute();
        $message = 'SUCCESS: You have deleted history period.';

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = 'ERROR: You have not deleted history period';


    }
    return $message;
}

function add_new_period($period_name,$period_start,$period_end){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare("INSERT INTO work_periods(period_name,start_date,end_date)
                                 VALUES(?, ?, ?)");
        $results->bindparam(1, $period_name);
        $results->bindparam(2, $period_start);
        $results->bindparam(3, $period_end);
        $results->execute();

        $message = "Period successfully added.";

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = "Error adding period, please try again.";
    }
    return $message;
}

function edit_period_date_range($period_id,$start_date,$end_date){
    require UC_ROOT.'/db.php';

    try {
        $results = $db->prepare ("UPDATE work_periods
                              SET start_date = ?, end_date = ?
                              WHERE id = ?");
        $results->bindparam(1,$start_date);
        $results->bindparam(2,$end_date);
        $results->bindparam(3,$period_id);
        $results->execute();
        $message = "Successfully updated period date range.";

    } catch (PDOException $e) {
        echo "error updating period date range: " . $e;
        $message = "Error updating period date range.";
    }
    return $message;
}

function get_period_list () {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->query ("SELECT id, period_name, start_date,end_date,current_period
                                FROM work_periods
                                ORDER BY id DESC");

    } catch (PDOException $e) {
        echo "error finding period list" . $e;

    }
    $periods = $results->fetchAll (PDO::FETCH_ASSOC);
    return $periods;
}

function get_period_by_id ($id) {
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("SELECT id, period_name, start_date,end_date,current_period
                                FROM work_periods
                                WHERE id = ?");
        $results->bindparam(1,$id);
        $results->execute();
        $period = $results->fetch (PDO::FETCH_ASSOC);
        return $period;

    } catch (PDOException $e) {
        echo "error finding period list" . $e;

    }

}

function get_active_period() {
    require UC_ROOT.'/db.php';
    $active = 'Y';
    try {
        $results = $db->prepare ("SELECT id, period_name, start_date,end_date
                                FROM work_periods
                                WHERE current_period = ?");
        $results->bindparam(1,$active);
        $results->execute();
        $active_period = $results->fetch (PDO::FETCH_ASSOC);
        return $active_period;

    } catch (PDOException $e) {
        echo "error finding period list" . $e;

    }


}

function select_current_period($period_id){
    require UC_ROOT.'/db.php';
    $activate = 'Y';
    deactivate_current_period();
    try {
        $results = $db->prepare ("UPDATE work_periods
                              SET current_period = ?
                              WHERE id = ?");
        $results->bindparam(1,$activate);
        $results->bindparam(2,$period_id);
        $results->execute();
        $message = "Successfully updated current period.";

    } catch (PDOException $e) {
        echo "error updating current period : " . $e;
        $message = "Error updating current period .";
    }
    return $message;
}

function deactivate_current_period(){
    require UC_ROOT.'/db.php';
    $deactivate = 'N';
    $activated = 'Y';
    try {
        $results = $db->prepare ("UPDATE work_periods
                              SET current_period = ?
                              WHERE current_period = ?");
        $results->bindparam(1,$deactivate);
        $results->bindparam(2,$activated);
        $results->execute();
        $message = "Successfully updated current period.";

    } catch (PDOException $e) {
        echo "error updating current period : " . $e;
        $message = "Error updating current period .";
    }
    return $message;
}
function delete_period($period_id){
    require UC_ROOT.'/db.php';
    try {
        $results = $db->prepare ("DELETE FROM work_periods
                              WHERE id = ?");
        $results->bindparam(1,$period_id);
        $results->execute();
        $message = "Successfully deleted period.";

    } catch (PDOException $e) {
        echo "error deleting period : " . $e;
        $message = "Error deleting period .";
    }
    return $message;
}


function time_to_seconds($time){
    $seconds = strtotime("1970-01-01 $time UTC");
    return $seconds;
}

function multiply_time($time,$factor){ //this works because $time is always less that 24 hours.
    $seconds = strtotime("1970-01-01 $time UTC");
    $result_in_seconds = $seconds * $factor;
    return $result_in_seconds;

}


function add_time($time1,$time2){
    $addition_in_seconds = $time1+$time2;
    return $addition_in_seconds;
}
function seconds_to_hours($seconds){
    $sign = "";
    if($seconds < 0){
        $sign = '-';
        $seconds = -1 * $seconds;
    }
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);


    if (strlen($hours) == 1){
        $hours = "0".$hours;
    }
    if (strlen($minutes) == 1){
        $minutes = "0".$minutes;
    }
    return "$sign $hours:$minutes";
}

function get_empty_logs(){
    require UC_ROOT.'/db.php';

    try {
        $results = $db->query ("SELECT id,student_id,date_worked
                                FROM work_hours
                                WHERE end_time IS NULL");

        $results->execute();
        $logs = $results->fetchAll (PDO::FETCH_ASSOC);

        return $logs;
    } catch (PDOException $e) {
        echo "error selecting products" . $e;

    }
}
