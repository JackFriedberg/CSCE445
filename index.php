<?php
    include_once "../dbh.inc.php";
    session_start();
?>


<html>
    <head>
        <div class="jumbotron text-center">
            <title>UpQuiz Home</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <link rel="stylesheet" type="text/css" href="style.css">
        </div>
    </head>
    <body>
  
        <div class="jumbotron text-center">
            <h1>UpQuiz</h1>      
        </div>
        <div></div>

        <?php
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        ?>

        <div class="jumbotron text-center">
            <h2>List of topics</h2>
        </div>

        <form action="/initial.php" method="POST">
            <button type="submit" class="btn btn-primary btn-floating col-md-4 center-block" > American Revolution </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4 center-block" > Yugioh </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4 center-block" > CSCE 445 </button>
        </form>

        <div class="jumbotron text-center">
            <h2>Sign-Up</h2>
        </div>

        <form action="/signup.php" method="POST" >
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="UserUid" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email-address</label>
                <input type="email" name="UserEmail" placeholder="Enter E-Mail">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="UserPwd" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <input type="password" name="UserPwd2" placeholder="Repeat Password">
            </div>
            <button type="submit" class="btn btn-primary" name="signup-submit"> Create Account </button>
        </form>
    </body>
</html>
