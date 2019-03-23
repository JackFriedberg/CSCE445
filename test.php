<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
    /* http://445dev1.azurewebsites.net/initial.php*/
?>

Question <br><br>

<?php 
    $query = mysql_query("SELECT * FROM Questions WHERE qIndex = 1");

    while ($row = mysql_fetch_assoc($query)) {
        echo $row['qText1'];// . '<input type="radio" name="option_1" value="option1"><br>';   
        echo $row['qText2'];// . '<input type="radio" name="option_1" value="option2"><br>';  
        //echo $row['option3'] . '<input type="radio" name="option_1" value="option3"><br>';  
        //echo $row['option4'] . '<input type="radio" name="option_1" value="option4"><br>';      
    }
    
    $var = "select from answer questions where answer ='4'";
    
    if (isset($var)) {
        echo 'correct answer';
    } else {
        echo 'wrong answer';
    }
    ?>