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
        $stmt = mysqlsrv_stmt_init($conn);
        if(!mysqlsrv_stmt_prepare($stmt, $sql)){
            echo 'SQL Error:';
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
        }
        else {
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            
            mysqlsrv_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
            mysqlsrv_stmt_execute($stmt);
        }
    }



}
else {
    echo '<h1> HELP</h1>';
}

?>