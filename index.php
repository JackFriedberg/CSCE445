



<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> Hello </p>  
  
<?php
  
  
$dbServerName = "csce445-project.database.windows.net";
$dbUsername = "Team3";
$dbPassword = "noQuizToday1";
$dbName = "Users";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
  
  $sql = "SELECT * FROM Users;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
   
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
     echo $row['email'] . "<br>";
    }
  }
  else {
  echo 'No Results';
  }
  ?>

  
 </body>
</html>
