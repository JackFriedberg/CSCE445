<?php

chdir('..');
include_once "dbh.inc.php";
session_start();

if(isset($_POST['correct'])){
    if($_SESSION['question'] % 2 == 0){
        $_SESSION['question']++;
    }
    else if ($_SESSION['question'] % 2 == 1){
        $_SESSION['question']++;
        $_SESSION['question']++;
    }
    else {
        //idk it failed
    }
}
else if (isset($_POST['incorrect1'])){
    $_SESSION['question']++;    
}

else if (isset($_POST['incorrect3'])){
    $_SESSION['question']++;    
}

else if (isset($_POST['incorrect2'])){
    $_SESSION['question']++;    
}
else {
    //idk it failed
}


header("Location: /initial.php");
exit();

?>
