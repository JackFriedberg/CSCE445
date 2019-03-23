<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
?>


<html>
    <head>
        <title>UpQuiz</title>
    </head>
    <body>  

        <?php
            $sql = "SELECT * FROM Questions WHERE qIndex = " . strval($_SESSION["question"]);
            $test = sqlsrv_query($conn, $sql);

            if($test){
                $row = sqlsrv_fetch_array($test, SQLSRV_FETCH_ASSOC)
                echo $row['qText1']."<br />";
                echo $row['qText2']."<br />";
                echo $row['answers1']."<br />";
                echo $row['answers2']."<br />";
                echo $row['context1_1']."<br />";
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

            $_SESSION['question']++; /* Increments the session variable after the query*/
        ?>


        <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
            <button type="submit">next question</button>
        </form>


    </body>
</html>
