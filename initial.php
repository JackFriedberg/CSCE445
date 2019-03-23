<?php
 chdir('..');
 include_once "dbh.inc.php";
?>


<html>
 <head>
  <title>UpQuiz</title>
 </head>
 <body>
  
  <p> SQL Query with Q1 </p>  
  <form action="http://445dev3.azurewebsites.net/initial.php" method="get">
  <button type="submit">Submit</button>
  </form>

<?php

$questionIndex = 2;
echo $_SESSION["question"] . "<br/>";

echo "Question Variable: " . strval($_SESSION["question"]) . "<br/>";
$sql = "SELECT * FROM Questions WHERE qIndex = " . strval($questionIndex);
$test = sqlsrv_query($conn, $sql);

if($test){
 while ($row = sqlsrv_fetch_array($test, SQLSRV_FETCH_ASSOC)) {
    echo $row['qText1']."<br />";
    echo $row['qText2']."<br />";
    echo $row['answers1']."<br />";
    echo $row['answers2']."<br />";
    echo $row['context1_1']."<br />";
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
