
<?php
include_once '../dhb.inc.php'
?>


<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> Hello </p>  
  
<?php
  
  $sql = "SELECT * FROM Users;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

if($result){
 
 echo 'Good Query';
 
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
     echo $row['email'] . "<br>";
    }
  }
  else {
  echo 'No Results';
  }
}
else{
echo 'Bad Query';
}
?>

  
 </body>
</html>
