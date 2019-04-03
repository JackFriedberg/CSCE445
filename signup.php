<?php

chdir('..');
include_once "dbh.inc.php";
session_start();

if(IssET($POST['signup-submit'])){
 
    $username = $POST['uid'];
    $email = $POST['email'];
    $pwd = $POST['pwd'];
    $pwd2 = $POST['pwd2'];

    if(empty($username) || empty($email) || empty($pwd) || empty($pwd2)){
        //form not filled out
        header("Location: /index.php")
        exit();
    } //more error checking
    else {
  //      $sql = "INSERT INTO users (uid, email, pwd) VALUES ($username, $email, $pwd)";
        header("Location: /index.php")
        exit();
    }



}

?>