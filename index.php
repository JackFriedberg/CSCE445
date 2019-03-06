<?php

#include_once '../dbh.inc.php'

?>



<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> Hello </p>  
  
  <?php
  
  $sql = "SELECT *  FROM Users;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
   
  if($resultCheck > 0){
    while($row = my_sqli_fetch_assoc($result)){
     echo $row['email'];
    }
  }
  ?>

  
 </body>
</html>
