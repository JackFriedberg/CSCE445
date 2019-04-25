<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");

    $username = $_SESSION['UserId'];
?>

<html>
    <head>
        <title>UpQuiz Home</title>
    </head>
    <body>

        <h1> My Account Page! </h1>

        <h3> You are signed in as <?php  echo $_SESSION['UserId'];?></h3>
       


        <h1>QuizStats </h1>
        <?php
            $sql = "SELECT * FROM quizStats WHERE username LIKE "."'". $username ."'"; 
            $result = sqlsrv_query($conn,$sql);
            
            if(sqlsrv_has_rows($result)){                
                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    
                    echo sqlsrv_num_rows($result);
                    echo 'text new: ' . $row['TEXTTOTAL'];


                    $quizType= strval($row["QUIZTYPE"]);
                    
                    $textTotal = intval($row["TEXTTOTAL"]);
                    $textCorrect = intval($row["TextCorrect"]);

                    
                    $textPercentage = $textCorrect / $textTotal;

                    $videoTotal = $row["VideoTotal"];
                    $videoCorrect = $row["VideoCorrect"];
                    $videoPercentage = $videoCorrect / $videoTotal;
                    
                    $overallTotal = $textTotal + $videoTotal;
                    $overallCorrect = $textCorrect + $videoCorrect;
                    $overallPercentage = $overallCorrect / $overallTotal;


                    echo '
                        <h3> ' . $quizType .' Quiz </h3>
                        <p> Total questions answered: ' . $overallTotal . '</p>
                        <p> Total questions correct: ' . $overallCorrect . '</p>
                        <p> Total question percentage: ' . $overallPercentage .'</p>
                        <br> </br>
                        <p> Text questions answered: ' . $textTotal . '</p>
                        <p> Text questions correct: ' . $textCorrect . '</p>
                        <p> Text question percentage: ' . $textPercentage .'</p>
                        <br> </br>
                        <p> Video questions answered: ' . $videoTotal . '</p>
                        <p> Video questions correct: ' . $videoCorrect . '</p>
                        <p> Video question percentage: ' . $videoPercentage .'</p>
                        <br> </br>
                        <br> </br>
                    ';
                }

                echo 'out of while';
            }
            else {
                echo 'nada';
            }
        ?>
       
    </body>
</html>
