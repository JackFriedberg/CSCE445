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
            $query = "SELECT * FROM Questions ";
            //$conn = sqlsrv_query($conn, $query);
            $result = mqsql_query($query);

            echo "<table>";

            while ($row = mqsql_fetch_array($result)) {
                $question = $row['qIndex'];
                echo "<tr><td>" . $row[qIndex] . "<br />";
            }
                
        ?>

        <form action="http://445dev1.azurewebsites.net/test.php" method="post">
            <button type="submit">Random Button</button>
        </form>
    </body>
</html>