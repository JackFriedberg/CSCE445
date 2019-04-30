<?php

include_once "../dbh.inc.php";
session_start();
$corrrectness = false;


if(isset($_POST['amRev'])){

    echo 'Amrev';
}
else {
    echo 'Not done yet!';
}

?>