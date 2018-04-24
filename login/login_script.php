<?php
include '../db.php';
if(isset($_POST['login'])){
    $errMsg = '';
    $try_username = trim($_POST['username']);
    $try_password = trim($_POST['password']);
    if($try_username == '')
        $errMsg .= 'You must enter your Username<br>';

    if($try_password == '')
        $errMsg .= 'You must enter your Password<br>';
    if($errMsg == '') {
        try {
            $stmt = $db->prepare('SELECT username,password,first_name,last_name,user_id, account_type
                                      FROM  users
                                      WHERE username = ? AND password= ?');


            $stmt->bindParam(1, $try_username);
            $stmt->bindParam(2, $try_password);
            $stmt->execute();

            $count = $stmt->rowCount();
            if ($count > 0) {
                session_start();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['account_type'] = $user['account_type'];
                $_SESSION['currentUserID'] = $user['user_id'];
                header("location: ../index.php");
            }else{
                $errMsg .= 'Username or password is not found.<br>';
            }

        } catch (PDOException $e) {
            echo "query error.." . $e;
        }

    }
}
if(isset($_POST['register_script'])){

    $errMsg = '';
    $try_student_id = trim($_POST['student_id']);
    $try_username = trim($_POST['register_username']);
    $try_password = trim($_POST['register_password']);
    $try_retype_password = trim($_POST['retype_register_password']);


    if(strlen($try_student_id) != 6 || !ctype_digit($try_student_id) )
        $errMsg .= 'Please enter a valid Student ID (6 digits).<br>';

    if(strlen($try_username) < 5 || strlen($try_username) > 12 || !ctype_alnum($try_username ))
        $errMsg .= 'You must enter a valid username.<br>';
    if(strlen($try_password) < 5 || strlen($try_password) > 12 || !ctype_alnum($try_username ))
        $errMsg .= 'You must enter a valid password.<br>';
    if($errMsg == '') {
        try {
            $stmt = $db->prepare('SELECT student_id
                                      FROM  users
                                      WHERE  student_id= ?');


            $stmt->bindParam(1, $try_student_id);
            $stmt->execute();

            $count = $stmt->rowCount();
            if ($count > 0) {
                $errMsg .= 'Student ID already registered.'.$count.'<br>If you have forgotten your username OR password<br>please contact the developers.<br>';
            }
        } catch (PDOException $e) {
            echo "query error.." . $e;
        }

        try {
            $stmt = $db->prepare('SELECT username
                                      FROM  users
                                      WHERE  username= ?');
            $stmt->bindParam(1, $try_username);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $errMsg .= 'Username already taken.<br>Please try another username.<br>';
            }
        } catch (PDOException $e) {
            echo "query error.." . $e;
        }

        try {
            $stmt = $db->prepare('SELECT student_id
                                      FROM  students
                                      WHERE  student_id= ?');


            $stmt->bindParam(1, $try_student_id);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 0) {
                $errMsg .= 'Student ID not eligible for account.<br>';
            }
        } catch (PDOException $e) {
            echo "query error.." . $e;
        }

        if($errMsg == '') {
            $user_info = get_student_info($try_student_id);
            $first_name = $user_info[0]['first_name'];
            $last_name = $user_info[0]['last_name'];
            try {
                $account_type = 'st';
                $stmt = $db->prepare("INSERT INTO users(username,password,student_id,first_name,last_name,account_type)
                                 VALUES(?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $try_username);
                $stmt->bindParam(2, $try_password);
                $stmt->bindParam(3, $try_student_id);
                $stmt->bindParam(4, $first_name);
                $stmt->bindParam(5, $last_name);
                $stmt->bindParam(6, $account_type);
                $stmt->execute();


            } catch (PDOException $e) {
                echo "Query error." . $e;

            }
            header("location: register_success.php");

        }else{
            header("location: register_fail.php?registration=true&regerrmsg=".$errMsg);
        }




    }else{
        header("location: register_fail.php?registration=true&regerrmsg=".$errMsg);
    }
}
