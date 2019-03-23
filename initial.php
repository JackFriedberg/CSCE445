<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
    /* http://445dev1.azurewebsites.net/initial.php*/
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
                
                $row = sqlsrv_fetch_array($test, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
                            
                echo "Question 1 text: " . $row['qText1']."<br />";
                echo "Question 2 text: " . $row['qText2']."<br />";    
                
                $question1Answers = explode(";", $row['answers1']); /* delimts the string into an array */
                $question2Answers = explode(";", $row['answers2']);
                
                echo "Answers for Question 1: <br />";
                foreach ($question1Answers as &$value1) { /* for loop goes length of array, stores curr value in $value1 */
                    echo "----". $value1 . "<br />"; 
                }
                echo "Answers for Question 2: <br />";
                foreach ($question2Answers as &$value2) {
                    echo "----". $value2 . "<br />";
                }
                
                echo "Context 1 text: " . $row['context1_1']."<br />";
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
            sqlsrv_free_stmt($getResults); /* idk what this does */
            $_SESSION['question']++; /* Increments the session variable after the query*/
        ?>

        <!--
        This is where answer selection needs to be validated.
        If the correct answer is chosen, the below button action should be 
        triggered, most likely with javascript (the user shouldnt have to push a button).
        If incorrect, the show/hide functionality needs to be implemented(Question 1 stuff 
        hidden, Question 2 stuff shown).
        -->

        <form action="http://445dev1.azurewebsites.net/initial.php" method="post">
            <button type="submit">Next Question</button>
        </form>

    </body>
</html>
