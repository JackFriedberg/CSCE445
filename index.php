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
            <div class="row justify-content-sm-left">
                <div class="col-sm-10 col-md-4">
                    <div class="card border-info">
                        <div class="card-header"> Login </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <form class="form-signin" action="/signup.php" method="POST" >
                                        <input type="text" class="form-control mb-2" placeholder="Email">    
                                        <input type="password" class="form-control mb-2" placeholder="Password">    
                                        <button type="submit" class="btn btn-lg btn-primary btn-block mb-1">Sign-In</button>
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

            <div class="row justify-content-sm-right">
                <h2>List of Topics</h2>      
            </div>

            <div class="btn-vertical">        
                <form action="/initial.php" method="POST">
                    <button type="submit" class="btn btn-primary btn-floating col-sm-5"> American Revolution </button>
                    <button type="submit" class="btn btn-primary btn-floating col-sm-5"> Yugioh </button>
                    <button type="submit" class="btn btn-primary btn-floating col-sm-5"> CSCE 445 </button>
                </form>
            </div>
        </div>
            
    </body>
</html>
