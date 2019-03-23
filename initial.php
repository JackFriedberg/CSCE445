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
            $sql = "SELECT * FROM amrev_questions WHERE qIndex = " . strval($_SESSION["question"]);
            $questions = sqlsrv_query($conn, $sql);

            
            $sql = "SELECT * FROM amrev_options WHERE qIndex = " . strval($_SESSION["question"]);
            $options = sqlsrv_query($conn, $sql);

            
            $sql = "SELECT * FROM amrev_context WHERE qIndex = " . strval($_SESSION["question"]);
            $context = sqlsrv_query($conn, $sql);

            if($questions){
                
                $row = sqlsrv_fetch_array($questions, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
            
                echo "Question 1 text: " . $row['QText']."<br />";    
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

            if($options){
                
                $row = sqlsrv_fetch_array($options, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
            
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

            if($context){
           
                $row = sqlsrv_fetch_array($context, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
            
                echo "Answer 1 text: " . $row['Embed']."<br />";
                echo "Answer 2 text: " . $row['Link']."<br />";    
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

        <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
            <button type="submit">Next Question</button>
        </form>

        <div id="Context1">
            <h3>Historical Information #1:</h3>
            <div>
                <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/gzALIXcY4pg?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div>
                <p> <?php echo "php text test" ?>  </p>
            </div>
            
        </div>



    </body>
</html>
