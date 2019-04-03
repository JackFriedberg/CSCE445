<?php

include_once "../dbh.inc.php";
session_start();

if(isset($_POST['signup-submit'])){

    $username = $_POST['UserUid'];
    $email = $_POST['UserEmail'];
    $pwd = $_POST['UserPwd'];
    $pwd2 = $_POST['UserPwd2'];

    
    $username = mysql_real_escape_string($username);
    $email = mysql_real_escape_string($email);
    $pwd = mysql_real_escape_string($pwd);
    $pwd2 = mysql_real_escape_string($pwd2);

    if(empty($username) || empty($email) || empty($pwd) || empty($pwd2)){
        //form not filled out
        echo 'Something empty';
    } //more error checking
    else {

        $sql = "INSERT INTO users (uid, email, pwd) VALUES ('$username', '$email', '$pwd')";
        $query = sqlsrv_query($conn, $sql);

        if($query){
            echo 'Successful Query';
        }
        else {
            echo 'SQL Error:';
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }    
        }
    }



}
else {
    echo '<h1> HELP</h1>';
}

?>