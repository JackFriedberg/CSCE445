<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
    /* http://445dev1.azurewebsites.net/initial.php*/
?>

Question <br><br>

<?php 
    $sql = "SELECT * FROM amrev_options WHERE qIndex = " . strval($_SESSION["question"]);
    $options = sqlsrv_query($conn, $sql);
    
    if($options){
        $row = sqlsrv_fetch_array($test, SQLSRV_FETCH_ASSOC);

        echo "Answer 1 text: " . $row['Option1']."<br />";
        echo "Answer 2 text: " . $row['Option2']."<br />"; 
        
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
?>