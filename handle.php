<?php

include_once "../dbh.inc.php";
session_start();


$corrrectness = false;

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

if(isset($_SESSION['UserId'])){

    $whereStatement = " WHERE username LIKE "."'". $_SESSION['UserId'] ."'". "AND  QuizType LIKE "."'". $_SESSION['quizType'] ."'" ;

    $totalString = $_SESSION['tempQuestionType'] . "Total";
    $correctString = $_SESSION['tempQuestionType'] . "Correct";
    $setStatement =  "SET " . $totalString . " = (SELECT " . $totalString . " FROM quizStats" . $whereStatement . ") + 1";

    if($correctness){
        //add to setStatement
        $setStatement = $setStatement . ", " . $correctString . " = (SELECT " . $correctString . " FROM quizStats" . $whereStatement . ") + 1";

    }

    $sql = "UPDATE QuizStats " . $setStatement . $whereStatement;

    $questions = sqlsrv_query($conn, $sql);
}
   

header("Location: /initial.php");
exit();

?>
