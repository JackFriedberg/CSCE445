<?php

include_once "../dbh.inc.php";
session_start();


if(isset($_POST['amRev'])){
    $_SESSION['quizType'] = "amrev";

    echo 'Question Progress: '. $_GET['progress'] .' 
    ';

    //header("Location: /initial.php");
}
else {
    header("Location: /myAccount.php?NotReady");
}

?>