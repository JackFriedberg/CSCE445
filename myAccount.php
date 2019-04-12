<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");
?>

<html>
    <style>
        #myProgress {
            width: 100%;
            background-color: #ddd;
        }

        #myBar {
            width: 40%;
             height: 30px;
             background-color: #4CAF50;
        }
    </style>
    <head>
        <title>UpQuiz Home</title>
    </head>
    <body>

        <h1> My Account Page! </h1>

        <h3> You are signed in as <?php  echo $_SESSION['UserId'];?></h3>
        <div id="myProgress">
            <div id="myBar"></div>
        </div>

        <?php
            $sql = "SELECT * FROM quizStats WHERE username = ". strval($_SESSION["UserID"]);
            $result = sqlsrv_query($conn,$sql);
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                $quizTypeShit= $row["QUIZTYPE"];
                $correctPercentage = $row["CORRECTPERCENTAGE"];
                $textContextCorrect = $row["TEXTCONTEXTCORRECT"];
                $videoContextCorrect = $row["VIDEOCONTEXTCORRECT"];
                echo '

                ';
            }
        ?>

    </body>
</html>