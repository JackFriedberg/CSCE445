<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
    /* http://445dev1.azurewebsites.net/initial.php*/
?>

<html>
    <head>
        <title>UpQuiz</title>
    </head>
    <body>  
        
        <?php 
            $query = "SELECT * FROM Questions"
            $conn = sqlsrv_query($conn, $sql);

            while ($row = $query ->fetch_assoc()):
                $question = $row['qIndex'];
                echo $question . "<br />";
            endwhile;
        ?>

        <form action="http://445dev1.azurewebsites.net/initial.php" method="post">
            <button type="submit">Random Button</button>
        </form>
    </body>
</html>