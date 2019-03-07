
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
 while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
     echo ($row['email']);
    }
}
else{
  echo (sqlsrv_errors());
}
?>

  
 </body>
</html>
