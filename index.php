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
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        $_SESSION['questionState'] = 1;
        ?>

        <form action="/initial.php" method="POST">
            <button type="submit"> Press me to start the quiz! </button>
        </form>

    </body>
</html>