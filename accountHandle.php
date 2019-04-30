<?php

include_once "../dbh.inc.php";
session_start();


if(isset($_POST['amRev'])){

    
    $_SESSION['quizType'] = "amrev";
    header("Location: /initial.php");
}
else {
    header("Location: /myAccount.php?NotReady");
}

?>