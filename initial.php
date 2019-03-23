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
            $returned = sqlsrv_query($conn, $sql);

            if($returned){
                    echo $returned['qText1']."<br />";
                    echo $returned['qText2']."<br />";
                    echo $returned['answers1']."<br />";
                    echo $returned['answers2']."<br />";
                    echo $returned['context1_1']."<br />";
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

            $_SESSION['question']++; /* Increments the session variable after the query*/
        ?>


        <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
            <button type="submit">next question</button>
        </form>


    </body>
</html>
