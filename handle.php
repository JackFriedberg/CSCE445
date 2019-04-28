<?php

include_once "../dbh.inc.php";
session_start();
$corrrectness = false;


if(isset($_POST['video'])){
    $_SESSION['questionType'] = "video";
    $_SESSION['question'] = 1;
    header("Location: /initial.php");
}
if(isset($_POST['text'])){
    $_SESSION['questionType'] = "text";
    $_SESSION['question'] = 1;
    header("Location: /initial.php");
}
if(isset($_POST['random'])){
    $_SESSION['questionType'] = "random";
    $_SESSION['question'] = 1;
    header("Location: /initial.php");
}


if(isset($_POST['correct'])){
    if($_SESSION['question'] % 2 == 0){
        $_SESSION['question']++;
    }
    else if ($_SESSION['question'] % 2 == 1){
        $_SESSION['question']++;
        $_SESSION['question']++;
    }
    $correctness = true;
}
else {
    $_SESSION['question']++;
}


//stores new quiz stats
if(isset($_SESSION['UserId'])){

    $whereStatement = " WHERE username LIKE "."'". $_SESSION['UserId'] ."'". "AND  QuizType LIKE "."'". $_SESSION['quizType'] ."'" ;
    $totalString = $_SESSION['tempQuestionType'] . "total";
    $correctString = $_SESSION['tempQuestionType'] . "Correct";
    $setStatement =  "SET " . $totalString . " = (SELECT " . $totalString . " FROM quizStats" . $whereStatement . ") + 1";

    if($correctness){ //adds correct question counter to edit request
        $setStatement = $setStatement . ", " . $correctString . " = (SELECT " . $correctString . " FROM quizStats" . $whereStatement . ") + 1";
    }

    //puts the SQL query together and sends query to update correct/total count
    $sql = "UPDATE QuizStats " . $setStatement . $whereStatement;
    $questions = sqlsrv_query($conn, $sql);

    //updates where user is in quiz
    $sql = "UPDATE QuizProgress SET questionNumber = " . $_SESSION['question'] . $whereStatement;
    $questions = sqlsrv_query($conn, $sql);
}

header("Location: /initial.php");
exit();
?>
