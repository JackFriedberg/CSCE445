<?php
 chdir('..');
 include_once "dbh.inc.php";
session_start();
$SESSION["question"] = 1;
?>


<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> SQL Query with list of user emails: </p>  




<form action="http://445dev3.azurewebsites.net/initial.php" method="POST">
    <button type="submit"> PRESS me to start the quiz! </button>
</form>

  
 </body>
</html>
