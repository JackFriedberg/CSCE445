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
                
                $row = sqlsrv_fetch_array($test, SQLSRV_FETCH_ASSOC);
                            
                echo "Question 1 text: " . $row['qText1']."<br />";
                echo "Question 2 text: " . $row['qText2']."<br />";    
                
                $question1Answers = explode(";", $row['answers1']);
                $question2Answers = explode(";", $row['answers2']);
                
                echo "Answers for Question 1: <br />";
                foreach ($question1Answers as &$value1) {
                    echo "     ". $value1 . "<br />";
                }

                echo "Answers for Question 2: <br />";
                foreach ($question2Answers as &$value2) {
                    echo "     ". $value2 . "<br />";
                }
                
                echo "Context 1 text: " . $row['contect1_1']."<br />";
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
