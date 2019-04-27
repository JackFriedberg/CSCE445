<?php

include_once "../dbh.inc.php";
session_start();




if(isset($_POST['correct'])){

    echo 'Correct answer, type: ' . $_SESSION['tempQuestionType'];

    if($_SESSION['question'] % 2 == 0){
        $_SESSION['question']++;
    }
    else if ($_SESSION['question'] % 2 == 1){
        $_SESSION['question']++;
        $_SESSION['question']++;
    }

}
else {
    $_SESSION['question']++;

    echo 'inCorrect answer, type: ' . $_SESSION['tempQuestionType'];
    
    /*
    //update the sql database
    
    $sql = "UPDATE QuizStats Set ? WHERE username LIKE "."'". $_SESSION['UserId'] ."'". "AND  QuizType LIKE " ;

    //put paramters in array
    $params = array(&$username, &$email, &$hashedPwd);
             
    //prepare the statement
    if(!$prepared = sqlsrv_prepare($conn, $sql, $params)){
        //could't prepare the statement
        sqlsrv_free_stmt($prepared);
        header("Location: /initial.php?error=preparation");
        exit();
    }
    else {
        //execute the statement
        if(!sqlsrv_execute($prepared)){
            //couldn't execute the statement 
            sqlsrv_free_stmt($prepared);
            header("Location: /index.php?error=execution");
            exit();
        }
        else {
            //SUCCESS - added a user
            sqlsrv_free_stmt($prepared);
            header("Location: /index.php?signup=success");
            exit();
        }
    }
*/
}


//header("Location: /initial.php");
//exit();

?>
