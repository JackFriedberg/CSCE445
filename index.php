<?php
 chdir('..');
 include_once "dbh.inc.php";
 session_start();
$_SESSION['qIndex'] = 1;
?>


<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> SQL Query with list of user emails: </p>  




<form action="http://445-termproject.azurewebsites.net/initial.php">
    <input type="hidden" name="name">  
    <button type="submit"> PRESS me to start the quiz! </button>
</form>

  
 </body>
</html>
