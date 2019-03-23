<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
    /* http://445dev1.azurewebsites.net/initial.php*/
?>

<html>
    <head>
    <title> UpQuiz </title>
    </head>
    <body>
    <center>

    <?php 
        $sql = "SELECT * FROM amrev_questions WHERE qIndex = " . strval($_SESSION["question"]);
        $questions = sqlsrv_query($conn, $sql);
        $sql = "SELECT * FROM amrev_options WHERE qIndex = " . strval($_SESSION["question"]);
        $options = sqlsrv_query($conn, $sql);
        $sql = "SELECT * FROM amrev_context WHERE qIndex = " . strval($_SESSION["question"]);
        $context = sqlsrv_query($conn, $sql);

        
        if($questions){
            $row = sqlsrv_fetch_array($questions, SQLSRV_FETCH_ASSOC); 
            $questionText = $row['QText'];

            echo "<br>";
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

    </center>
    </body>
</html>