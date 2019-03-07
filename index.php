<?php
include_once './dhb.inc.php'
?>


<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> SQL Query with list of user emails: </p>  
  
<?php
 
 $sql = "SELECT * FROM Users;";
 $result = sqlsrv_query($conn, $sql);


if($result){
 while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
     echo $row['email'].", ".$row['pass']."<br />";
    }
}
else{
 echo 'SQL Error:';
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
