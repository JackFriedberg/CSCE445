<?php
    include_once "../dbh.inc.php";
    session_start();
?>


<html>
    <head>
        <title>UpQuiz Home</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron text-center light-blue lighten-3 white-text mx-2 mb-5">
                <h1>UpQuiz</h1>
                <hr class="my-2">
                <p> Make an account and learn with us! Topics ranging from American Revoution to Trigonometry. To get the best out of this platform make an account to get performance analytics based on your past quizzes, so start learning today!</p>      
            </div>
        </div>

        <?php
        $_SESSION['question'] = 1; /*sets session variable to 1 for when the next page comes */
        ?>

        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-sm-10 col-md-8">
                    <div class="card border-info">
                        <div class="card-header"> Login </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCVQWvUj6iBFfnqigz7gp_9uv9603FyA-m-vz1mJZS-HDJw4Kk">    
                                </div>
                                <div class="col-md-8">
                                    <form class="form-signin" action="/login.php" method="POST" >
                                        <input type="text" name="Username" class="form-control mb-2" placeholder="Username">    
                                        <input type="password" name="UserPwd" class="form-control mb-2" placeholder="Password">    
                                        <button type="submit" name="login-submit" class="btn btn-mb btn-primary btn-block mb-2">Sign-In</button><label class="checkbox float-left">
                                        <input type="checkbox" value="remember-me">Remember Me
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#register" class="float-right">Create an account </a>
                </div>
            </div> 
        </div>
        
        <div></div>
        <div></div>

        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="card-deck">
                    <div class="card mb-4" style="max-width:310px">
                        <img class="card-img-top img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Mathematics</h4>
                            <p class="card-text">Take the quiz on Trig and learn all the basics you need to start your college career!</p>
                            <button type="submit" class="btn btn-outline-info btn-rounded waves-effect">Start Quiz<i class="fas fas fa-play pl-1"></i></button>
                        </div>
                    </div>

                    <form action="/initial.php" method="POST">
                        <div class="card mb-4" style="max-width:310px">
                            <img class="card-img-top img-fluid" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">History</h4>
                                <p class="card-text">Want to learn more about America's past? Go through the journey with the American Revolution quiz and learn everything in a timeline fashion.</p>
                                <button type="submit" class="btn btn-outline-info btn-rounded waves-effect">Start Quiz<i class="fas fas fa-play pl-1"></i></button>
                            </div>
                        </div>
                    </form>
                
                    <div class="card mb-4" style="max-width:310px">
                        <img class="card-img-top img-fluid" src="https://mdbootstrap.com/img/Photos/Others/photo6.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Topic 3</h4>
                            <p class="card-text">Swag</p>
                            <button type="submit" class="btn btn-outline-info btn-rounded waves-effect">Start Quiz<i class="fas fas fa-play pl-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if(isset($_SESSION['UserId'])){
                echo '
                <form action="/myAccount.php" method="POST">
                    <button type="submit"> My Account </button>
                </form>
                <form action="/logout.php" method="POST">
                    <button type="submit"> Logout </button>
                </form>
                ';
            }
        ?>
        
    </body>
</html>
