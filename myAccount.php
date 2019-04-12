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
    <!--
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
                <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70"
                aria-valuemin="0" aria-valuemax="100" style="width:70%">
                  <span class="sr-only">70% Complete</span>
                </div>
              </div>
                '
            }
        ?>
        -->

    </body>
</html>