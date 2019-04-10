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
        <div class="container">
            <div class="jumbotron text-center">
                <h1>UpQuiz</h1>      
            </div>
        </div>

        <?php
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        ?>

        <div class="container pt-3">
            <div class="row justify-content-md-center">
                <div class="col-sm-5 col-sm-5">
                    <div class="card border-info">
                        <div class="card-header"> Login </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                <form class="form-signin" action="/signup.php" method="POST" >
                                        <input type="text" class="form-control sm-2" placeholder="Please enter your email">    
                                        <input type="password" class="form-control sm-2" placeholder="Please enter your password">    
                                        <button type="submit" class="btn btn-lg btn-primary btn-block sm-2" name="signup-submit">Sign-In</button>
                                        <label class="checkbox float-left">
                                            <input type="checkbox" value="remember-me">Remember Me
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="float-right">Create an account </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="jumbotron text-center">
                <h2>List of Topics</h2>      
            </div>
        </div>

        <form action="/initial.php" method="POST">
            <button type="submit" class="btn btn-primary btn-floating col-md-4" style="margin: 0 auto;"> American Revolution </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4" style="margin: 0 auto;"> Yugioh </button>
            <button type="submit" class="btn btn-primary btn-floating col-md-4" style="margin: 0 auto;"> CSCE 445 </button>
        </form>
    </body>
</html>
