<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");


    $username = strval($_SESSION['UserId']);


    // --------------------- QUIZ STATISTICS QUERIES -------------------------- //

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



    // --------------------- QUIZ PROGRESS QUERIES -------------------------- //
    $sql_Amrev = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'AmRev'";
    $amRev_result = sqlsrv_query($conn,$sql_Amrev);
    if($amRev_result){
        $row = sqlsrv_fetch_array($amRev_result, SQLSRV_FETCH_ASSOC);
        echo '<h3> Amrev Progress: ' . $row['questionNumber']  .'</h3>';
    }

    $sql_Math = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'math'";
    $math_result = sqlsrv_query($conn,$sql_Math);
    if($math_result){
        $row = sqlsrv_fetch_array($math_result, SQLSRV_FETCH_ASSOC);
        echo '<h3> Math Progress: ' . $row['questionNumber']  .'</h3>';
    }


?>

<html>
    <head>
        <title>My Account</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: url("https://img-aws.ehowcdn.com/877x500p/s3-us-west-1.amazonaws.com/contentlab.studiod/getty/f24b4a7bf9f24d1ba5f899339e6949f3");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .jumbotron {
                background-image: url("https://t4.ftcdn.net/jpg/01/08/25/95/240_F_108259589_cRwIo0e1RmYE4HIp2217gXXyJByB9ozb.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>
        
    <body>
        <div class="container">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="navbar-brand"><i class="fas fa-user"></i>My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Progress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link disabled" href="#"><?php  echo $_SESSION['UserId'];?></a>
                </li>
                <form action="/logout.php" method="POST">
                    <button type="submit" class="btn btn-primary btn-rounded">Logout</button>
                </form>
            </ul>
        </div>
        
        <form action="/initial.php" method="POST">
            <div class="container" style="width: 50%;">
                <div class="jumbotron text-center light-blue lighten-3 white-text mx-2 mb-5">
                    <h1>History: American Revolution</h1>
                    <button type="submit" class="btn btn-dark btn-rounded">Start<i class="fas fas fa-play pl-1"></i></button>
                    <hr class="my-2">
                </div>
            </div>
        </form>

        <div class="container" style="width: 50%;">
            <div class="jumbotron text-center light-blue lighten-3 white-text mx-2 mb-5">
                <h1>Math: Trigonometry</h1>
                <button type="submit" class="btn btn-dark btn-rounded">Start<i class="fas fas fa-play pl-1"></i></button>
                <hr class="my-2">
            </div>
        </div>

        <div class="container" style="width: 50%;">
            <div class="jumbotron text-center light-blue lighten-3 white-text mx-2 mb-5">
                <h1>Swag: Fun Topics</h1>
                <button type="submit" class="btn btn-dark btn-rounded">Start<i class="fas fas fa-play pl-1"></i></button>
                <hr class="my-2">
            </div>
        </div>
        
    </body>
</html>
