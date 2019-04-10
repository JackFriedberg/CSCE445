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
                                <div class="col-md-4 text-center">
                                    <img src="data:image/png;base64,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">    
                                </div>
                                <div class="col-md-8">
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
            </div>
            
            <div class="row justify-content-sm-right">List of Topics</div>

            <div class="btn-group-vertical">        
                <form action="/initial.php" method="POST">
                    <button type="submit" class="btn btn-primary btn-floating col-sm-5"> American Revolution </button>
                    <button type="submit" class="btn btn-primary btn-floating col-sm-5"> Yugioh </button>
                    <button type="submit" class="btn btn-primary btn-floating col-sm-5"> CSCE 445 </button>
                </form>
            </div>
        </div>
            
    </body>
</html>
