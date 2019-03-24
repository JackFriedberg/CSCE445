<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
?>

<html>
    <head>
        <title>UpQuiz</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

                echo'
                <div class="jumbotron text-center">
                    <h1>' . $questionText . '</h1>
                </div>
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

            if($options){
                $row = sqlsrv_fetch_array($options, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
                $option1 = $row['Option1'];
                $option2 = $row['Option2'];
                $option3 = $row['Option3'];
                $option4 = $row['Option4'];
                $answer = $row['Answer'];
                
                if($option1 == $answer){
                    $correct = $option1;
                    $incorrect1 = $option2;
                    $incorrect2 = $option3;
                    $incorrect3 = $option4;
                }
                else if($option2 == $answer){
                    $correct = $option2;
                    $incorrect1 = $option1;
                    $incorrect2 = $option3;
                    $incorrect3 = $option4;
                }
                else if($option3 == $answer){
                    $correct = $option3;
                    $incorrect1 = $option2;
                    $incorrect2 = $option1;
                    $incorrect3 = $option4;
                }
                else if($option4 == $answer){
                    $correct = $option4;
                    $incorrect1 = $option2;
                    $incorrect2 = $option3;
                    $incorrect3 = $option1;
                }

                echo'
                    <div>
                    <form id= "theForm" action="http://445dev3.azurewebsites.net/handle.php" method="post">
                            <button type="submit" class="btn btn-primary" name="correct">' . $correct . '</button>
                            <button type="submit" class= "btn btn-primary" name="incorrect1">' . $incorrect1 . '</button>
                            <button type="submit" class= "btn btn-primary" name="incorrect2">' . $incorrect2 . '</button>
                            <button type="submit" class= "btn btn-primary" name="incorrect3">' . $incorrect3 . '</button>
                    </form>
                    </div>
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
        ?>
    </body>

    <script>
        var ul = document.getElementById("theForm");
        for (var i = ul.children.length; i >= 0; i--) {
            ul.appendChild(ul.children[Math.random() * i | 0]);
        }
    </script>

</html>
