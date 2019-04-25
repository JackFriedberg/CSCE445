<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");
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
            $username = strval($_SESSION['UserId']);

            $sql = "SELECT * FROM quizStats WHERE username LIKE "."'". $username ."'"; 
            $result = sqlsrv_query($conn,$sql);
            
            $overallVideoTotal = 0;
            $overallVideoCorrect = 0;
            $overallTextTotal = 0;
            $overallTextCorrect = 0;
            $universalTotal = 0;
            $universalCorrect = 0;
            
            if(sqlsrv_has_rows($result)){                
                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
    
                    $quizType= strval($row["quiztype"]);
                    
                    $textTotal = intval($row["texttotal"]);
                    $textCorrect = intval($row["textCorrect"]);
                    $textPercentage = $textCorrect / $textTotal * 100;

                    $videoTotal = intval($row["videototal"]);
                    $videoCorrect = intval($row["videoCorrect"]);
                    $videoPercentage = $videoCorrect / $videoTotal * 100;
                
                    $overallTotal = $textTotal + $videoTotal;
                    $overallCorrect = $textCorrect + $videoCorrect;
                    $overallPercentage = $overallCorrect / $overallTotal * 100;

                    $overallVideoTotal += $videoTotal;
                    $overallVideoCorrect += $videoCorrect;
                    $overallTextTotal += $textTotal;
                    $overallTextCorrect += $textCorrect;
                    $universalTotal += $overallTotal;
                    $universalCorrect += $overallCorrect;


                    echo '
                        <h3> ' . $quizType .' Quiz </h3>
                        <p> Total questions answered: ' . $overallTotal . '</p>
                        <p> Total questions correct: ' . $overallCorrect . '</p>
                        <p> Total question percentage: ' . $overallPercentage .'%</p>
                        <br>
                        <p> Text questions answered: ' . $textTotal . '</p>
                        <p> Text questions correct: ' . $textCorrect . '</p>
                        <p> Text question percentage: ' . $textPercentage .'%</p>
                        <br>
                        <p> Video questions answered: ' . $videoTotal . '</p>
                        <p> Video questions correct: ' . $videoCorrect . '</p>
                        <p> Video question percentage: ' . $videoPercentage .'%</p>
                        <br> </br>
                    ';
                }
            }

            $universalPercentage = $universalCorrect/$universalTotal * 100;
            $overallVideoPercentage = $overallVideoCorrect/$overallVideoTotal * 100;
            $overallTextPercentage = $overallTextCorrect/$overallTextTotal * 100;

            echo '
                <h3> All Quizes </h3>
                <p> Questions answered: ' .  $universalTotal . '</p>
                <p> Questions correct: ' . $universalCorrect . '</p>
                <p> Question percentage: ' . $universalPercentage .'%</p>
                <br>
                <p> Text questions answered: ' . $overallTextTotal . '</p>
                <p> Text questions correct: ' . $overallTextCorrect . '</p>
                <p> Text question percentage: ' . $overallTextPercentage .'%</p>
                <br>
                <p> Video questions answered: ' . $overallVideoTotal . '</p>
                <p> Video questions correct: ' . $overallVideoCorrect . '</p>
                <p> Video question percentage: ' . $overallVideoPercentage .'%</p>
                <br>
            ';

        ?>
       
    </body>
</html>
