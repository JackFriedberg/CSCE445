<?php

include_once "../dbh.inc.php";
session_start();

if(isset($_POST['signup-submit'])){

    $username = $_POST['uid'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];

    if(empty($username) || empty($email) || empty($pwd) || empty($pwd2)){
        //form not filled out
        header("Location: /index.php");
    } //more error checking
    else {

        $sql = "INSERT INTO users (email, pwd) VALUES (" . $username. ", ". $email .", ". $pwd. ")";
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