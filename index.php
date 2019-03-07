
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
 
  $sql = "SELECT * FROM Users";
  $result = sqlsrv_query($conn, $sql);

if($result){
 echo 'Good Query';
 while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
     echo $row['email'].", ".$row['pass']."<br />";
    }
}
else{
 echo 'Bad Query';
  echo (sqlsrv_errors());
}

sqlsrv_free_stmt($getResults);
?>

  
 </body>
</html>
