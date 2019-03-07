


<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  
  <p> Hello </p>  
  
<?php
 $ServerName = "csce445-project.database.windows.net";
$connectionOptions = array(
"Database" => "Users",
"Uid" => "Team3",
"PWD" => "noQuizToday1"
    );

$conn = mysqlsrv_connect($ServerName, $connectionOptions);

if($conn){
    echo 'Good Connection';
}
else{
    echo 'Bad Connection';
}
 
 
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
