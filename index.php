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
  
        <div class="jumbotron-fluid text-center" style="height:100%; margin:0; padding:0">
            <h1>UpQuiz</h1>      
        </div>
        <div></div>

        <?php
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        ?>

        <div class="jumbotron text-center" style="height:100%; margin:0; padding:0">
            <h2>List of Topics</h2>      
        </div>
        <div></div>

        <form action="/initial.php" method="POST">
            <button type="submit" class="btn btn-primary btn-floating col-md-4" style="display: block; margin: 0 auto;"> American Revolution </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4" style="display: block; margin: 0 auto;"> Yugioh </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4" style="display: block; margin: 0 auto;"> CSCE 445 </button>
        </form>

        <form action="/signup.php" method="POST" >
            <div class="form-group mblank-4">
                <label>Username</label>
                <input type="text" class="form-control" name="UserUid" placeholder="Enter Username">
            </div>
            <div class="form-group mblank-4">
                <label>Email-address</label>
                <input type="email" class="form-control" name="UserEmail" placeholder="Enter E-Mail">
            </div>
            <div class="form-group mblank-4">
                <label>Password</label>
                <input type="password" class="form-control" name="UserPwd" placeholder="Enter Password">
            </div>
            <div class="form-group mblank-4">
                <input type="password" class="form-control" name="UserPwd2" placeholder="Repeat Password">
            </div>
            <button type="submit" class="btn btn-primary" name="signup-submit"> Create Account </button>
        </form>
    </body>
</html>
