<?php

chdir('..');
include_once "dbh.inc.php";
session_start();

if(isset($_POST['correct'])){
    if($_SESSION['question'] % 2 == 1){
        $_SESSION['question']++;
    }
    else {
        $_SESSION['question']++;
        $_SESSION['question']++;
    }
}
else {
    $_SESSION['question']++;
}

header("Location: /initial.php");
exit();

?>
