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
    } //more error checking
    else {

        $sql = "INSERT INTO users (email, pwd) VALUES (" . $username. ", ". $email .", ". $pwd. ")";
        sqlsrv_query($conn, $sql);
        header("Location: /index.php");
    }



}
else {
    echo '<h1> HELP</h1>';
}

?>