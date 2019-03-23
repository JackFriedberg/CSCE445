<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
?>


<html>
    <head>
        <title>UpQuiz Home</title>
    </head>
    <body>
  
        <p> upQuiz Home with list of topics: </p>  

        <?php
        $_SESSION['question'] = 1;
        $_SESSION['questionState'] = 1;
        $_SESSION['answer1']="butt";
        $_SESSION['answer2']="booty";
        $_SESSION['answer3']="ass";
        $_SESSION['answer4']="derriere";
        $_SESSION['answer5']="posterior region";
        ?>

        <form action="/initial.php" method="POST">
            <button type="submit"> Press me to start the quiz! </button>
        </form>

    </body>
</html>