
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
 
 
 echo $conn->PWD;
  $sql = "SELECT * FROM Users;";
  $result = sqlsrv_query($conn, $sql);
  #$resultRows = sqlsrv_num_rows($result);
  
 #echo ($resultRows);

if($result){
 echo 'Good Query';
 while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
     echo $row['email'].", ".$row['pass']."<br />";
    }
}
else{
 echo 'Bad Query';
  if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }
}

sqlsrv_free_stmt($getResults);
?>

  
 </body>
</html>
