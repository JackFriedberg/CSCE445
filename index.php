<?php
 chdir('..');
 include_once "dbh.inc.php";

session_start();
?>


<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> SQL Query with list of user emails: </p>  

<?php

$_SESSION['question'] = 1;
echo $_SESSION['question'];

?>


<form action="http://445dev3.azurewebsites.net/initial.php" method="POST">
    <button type="submit"> PRESS me to start the quiz! </button>
</form>

  
 </body>
</html>
