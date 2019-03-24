<?php

chdir('..');
include_once "dbh.inc.php";
session_start();

?>

<?php

if(isset($_POST['correct'])){

    $_SESSION['question']++;
    $_SESSION['question']++;
}
else {

    $_SESSION['question']++;

}



header("Location: initial.php");
exit();

?>
