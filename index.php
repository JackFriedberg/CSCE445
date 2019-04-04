<?php
    include_once "../dbh.inc.php";
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
            <button type="submit" class="btn-floating btn-lg jumbotron my-auto" style="font-size:24px"> <i class="fa fa-play"></i> </button>
        </form>

        <h3>Sign-Up</h3>
        <form action="/signup.php" method="POST" >
            <div class="form-group">
                <input type="text" name="UserUid" placeholder="Username">
                <input type="text" name="UserEmail" placeholder="E-Mail">
                <input type="password" name="UserPwd" placeholder="Password">
                <input type="password" name="UserPwd2" placeholder="Repeat Password">
                <button type="submit" name="signup-submit"></button>
            </div>
        </form>





    </body>
</html>
