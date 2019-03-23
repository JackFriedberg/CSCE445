<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
    /* http://445dev1.azurewebsites.net/initial.php*/
?>

Question <br><br>

<?php 
    $sql = mysql_query("SELECT * FROM amrev_options");
    $test = sqlsrv_query($conn, $sql);
    
    if($test){
        //$row = sqlsrv_fetch_array($test, SQLSRV_FETCH_ASSOC);

        while ($row = mysql_fetch_assoc($query)) {
            echo $row['Option1'] . '<input type="radio" name="option_1" value="option1"><br>';   
            echo $row['Option2'] . '<input type="radio" name="option_1" value="option2"><br>';  
            echo $row['Option3'] . '<input type="radio" name="option_1" value="option3"><br>';  
            echo $row['Option4'] . '<input type="radio" name="option_1" value="option4"><br>';      
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
?>
