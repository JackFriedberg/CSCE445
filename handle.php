<?php

chdir('..');
include_once "dbh.inc.php";
session_start();

?>

<?php

$_SESSION['question']++;


header("Location: initial.php");
exit();

?>
