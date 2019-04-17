<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");
?>

<html>
    <style>
        #progressbar {
            background-color: black;
             border-radius: 13px;
             /* (height of inner div) / 2 + padding */
            padding: 3px;
}

#progressbar>div {
  background-color: orange;
  width: 90%;
  /* Adjust with JavaScript */
  height: 20px;
  border-radius: 10px;
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
                    <div id ="progressbar">
                        <div></div>
                    </div>
                ';
            }
        ?>
        <div id ="progressbar">
                        <div value = "99" max="100"></div>
                    </div>

    </body>
</html>