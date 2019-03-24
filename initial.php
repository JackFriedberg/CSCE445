<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
?>

<html>
    test{
        text-align:center;
        font-weight:bold;
    }

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
                $questionText = $row['QText'];
                
                '<p class="test">'echo $questionText . "<br />"'</p>';

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
                $option1 = $row['Option1'];
                $option2 = $row['Option2'];
                $option3 = $row['Option3'];
                $option4 = $row['Option4'];
                echo'
                    <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
                        <button type="submit">' . $option1 . '</button>
                    </form>
                    <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
                        <button type="submit">' . $option2 . '</button>
                    </form>
                    <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
                        <button type="submit">' . $option3 . '</button>
                    </form>
                    <form action="http://445dev3.azurewebsites.net/initial.php" method="post">
                        <button type="submit">' . $option4 . '</button>
                    </form>
                ';
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
                $counter = 1;
                while($row = sqlsrv_fetch_array($context)){
                    $contextContent = $row['Embed'];
                    $contextSrc =  $row['Link'];
                    echo '
                        <div id="Context1">
                            <h3> Historical Information #'. strval($counter) .':</h3>
                            <div>
                                <p>' . $contextContent . '</p>    
                            </div>
                            <div>
                                <p>' . $contextSrc . '</p>
                            </div>
                        </div>
                    ';
                    
                $counter++;
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

        <?php 
            
            $context2Content = '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/gzALIXcY4pg?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                
            $context2Src = "YouTube";
       ?>

    </body>
</html>