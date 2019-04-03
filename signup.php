<?php

include_once "../dbh.inc.php";
session_start();

if(isset($POST['signup-submit'])){
 
    echo '<h1> IDK</h1>';

    $username = $POST['uid'];
    $email = $POST['email'];
    $pwd = $POST['pwd'];
    $pwd2 = $POST['pwd2'];

    if(empty($username) || empty($email) || empty($pwd) || empty($pwd2)){
        //form not filled out
        echo '<h1> empty</h1>'; 
    } //more error checking
    else {
        echo '<h1> in</h1>';

        $sql = "INSERT INTO users (uid, email, pwd) VALUES ($username, $email, $pwd)";
        sqlsrv_query($conn, $sql);
    }



}
else {
    echo '<h1> HELP</h1>';
}

?>