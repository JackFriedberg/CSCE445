<?php

include_once "../dbh.inc.php";
session_start();

if(isset($_POST['signup-submit'])){


    $username = $_POST['UserUid'];
    $email = $_POST['UserEmail'];
    $pwd = $_POST['UserPwd'];
    $pwd2 = $_POST['UserPwd2'];

    
    //$username = mysql_real_escape_string($username);
    //$email = mysql_real_escape_string($email);
    //$pwd = mysql_real_escape_string($pwd);
    //$pwd2 = mysql_real_escape_string($pwd2);

    if(empty($username) || empty($email) || empty($pwd) || empty($pwd2)){
        //form not filled out
        echo 'something empty';
    } //more error checking (pwd and pwd2 match, valid email, username already exists)
    else {

        $sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?)";
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $params = array(&$username, &$email, &$hashedPwd);

        
        if(!$prepared = sqlsrv_prepare($conn, $sql, $params)){
            //could't prepare the statement
            sqlsrv_free_stmt($prepared);
            header("Location: /index.php?error=preparation");
            exit();
        }
        else {
            if(!sqlsrv_execute($prepared)){
               //couldn't execute the statement 
                sqlsrv_free_stmt($prepared);
                header("Location: /index.php?error=execution");
                exit();
            }
            else {
                //SUCCESS - added a user
                sqlsrv_free_stmt($prepared);
                header("Location: /index.php?signup=success");
                exit();
            }
        }
    }
}
else {
    //didnt submit form
    header("Location: /index.php");
    exit();
}

?>