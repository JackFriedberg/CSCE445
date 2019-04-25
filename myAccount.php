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

            $universalPercentage = $universalCorrect/$universalTotal;
            $overallVideoPercentage = $opverallVideoCorrect/$overallVideoTotal;
            $overallTextPercentage = $overallTextCorrect/$overallTextTotal;

            echo '
                <h3> All Quizes </h3>
                <p> Questions answered: ' . $overallVideoTotal . '</p>
                <p> Questions correct: ' . $overallVideoCorrect . '</p>
                <p> Question percentage: ' . $overallVideoPercentage .'%</p>
                <br>
                <p> Text questions answered: ' . $overallTextTotal . '</p>
                <p> Text questions correct: ' . $overallTextCorrect . '</p>
                <p> Text question percentage: ' . $overallTextPercentage .'%</p>
                <br>
                <p> Video questions answered: ' . $universalTotal . '</p>
                <p> Video questions correct: ' . $universalCorrect . '</p>
                <p> Video question percentage: ' . $universalPercentage .'%</p>
                <br>
            ';

        ?>
       
    </body>
</html>
