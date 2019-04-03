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

        
        if($prepared = sqlsrv_prepare($conn, $sql, $params)){
            echo 'SQL Error:';
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            
            sqlsrv_free_stmt($prepared);
        }
        else {
            if(!sqlsrv_execute($prepared)){
                echo "Statement could not be executed.\n";  
                sqlsrv_free_stmt($prepared);
            }
            else {
                echo "Statement executed.\n";
                sqlsrv_free_stmt($prepared);
            }
        }
    }




}
else {
    echo '<h1> HELP</h1>';
}

?>