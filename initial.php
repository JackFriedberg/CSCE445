<?php
 chdir('..');
 include_once "dbh.inc.php";
?>

<style>
    .button {
	  display: block;
	  left: 100px;
	  top: 100px;
	  position: absolute;
	  padding: 15px 25px;
	  font-size: 24px;
	  cursor: pointer;
	  text-align: center;
	  text-decoration: none;
	  outline: none;
	  color: #fff;
	  background-color: #4CAF50;
	  border: none;
	  border-radius: 15px;
	  box-shadow: 0 9px #999;
	}
	
	.button:hover {background-color: #3e8e41}
	
	.button:active {
	  background-color: #3e8e41;
	  box-shadow: 0 5px #666;
	  transform: translateY(4px);
	}
</style>

<html>
 <head>
  <title>UpQuiz</title>
 </head>
 <body>
  
  <p> SQL Query with Q1 </p>  
  <form action="http://445-termproject.azurewebsites.net/initial.php" method="get">
  <button class="button">Submit</button>
  </form>

<?php

 $sql = "SELECT * FROM Questions WHERE qIndex = 1";
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