<?php
    include_once "../dbh.inc.php";
    session_start();
?>


<html>
    <head>
        <title>UpQuiz Home</title>
    </head>
    <body>
  
        <div class="container">
            <div align="center" class="page-header">
                <h1>UpQuiz</h1>      
            </div>
        </div>
        <div></div>

        <?php
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        ?>

        <h2>List of topics</h2>

        <form action="/initial.php" method="POST">
            <button type="submit" class="btn-floating btn-lg" ><i class="fa fa-play"></i> </button>
        </form>

        <h2>Sign-Up</h2>
        <form action="/signup.php" method="POST" >
            <div class="form-group">
                <input type="text" class="form-control" name="UserUid" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <input type="email" name="UserEmail" placeholder="Enter E-Mail">
            </div>
            <div class="form-group">
                <input type="password" name="UserPwd" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" name="UserPwd2" placeholder="Repeat Password">
            </div>
            <button type="submit" class="btn btn-primary" name="signup-submit"></button>
        </form>
    </body>
</html>
