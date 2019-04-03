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
        ?>

        <form action="/initial.php" method="POST">
            <button type="submit"> Press me to start the quiz! </button>
        </form>

        <h3>Sign-Up</h3>
        <form action="/signup.php" method="POST" >
            <div class="form-group">
                <input type="text" name="uid" placeholder="Username">
                <input type="text" name="email" placeholder="E-Mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd2" placeholder="Repeat Password">
                <button type="submit" name="signup-submit"></button>
            </div>
        </form>





    </body>
</html>
