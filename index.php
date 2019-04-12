<?php
    include_once "../dbh.inc.php";
    session_start();
?>


<html>
    <head>
        <title>UpQuiz Home</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
  
        <div class="jumbotron text-center">
            <h1>UpQuiz</h1>      
        </div>
        <div></div>

        <?php
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        $_SESSION['quizType'] = 10;
        $_SESSION['correctPercentage'] = 1;
        ?>

       <h2>List of topics</h2>
       <form  method="post" name="myform" action="/initial.php">
            <input type="text" name="mytext" maxlength="80" size="30">
            <input type="submit" value="Submit" >
        </form>

        <form action="/initial.php" method="POST">
            <button type="submit" name = "Amrev" class="btn btn-primary btn-floating col-md-4 center-block" > American Revolution </button>
            <button type="submit" name = "poop" class="btn btn-primary btn-floating col-md-4 center-block" > Yugioh </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4 center-block" > CSCE 445 </button>
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


        <h3>Login</h3>
        <form action="/login.php" method="POST" >
            <div class="form-group">

                <input type="text" name="Username" placeholder="Username">
                <input type="password" name="UserPwd" placeholder="Password">
                <button type="submit" name="login-submit"></button>
            </div>
        </form>

        <?php
            if(isset($_SESSION['UserId'])){
                echo '
                <form action="/myAccount.php" method="POST">
                    <button type="submit"> My Account </button>
                </form>
                <form action="/logout.php" method="POST">
                    <button type="submit"> logout </button>
                </form>
                ';
            }
        ?>
    </body>
</html>