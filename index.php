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
            <div class="jumbotron text-center">
                <h1>UpQuiz</h1>      
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
                                    <form class="form-signin" action="/signup.php" method="POST" >
                                        <input type="text" class="form-control mb-2" placeholder="Email">    
                                        <input type="password" class="form-control mb-2" placeholder="Password">    
                                        <button type="submit" class="btn btn-mb btn-primary btn-block mb-2">Sign-In</button>
                                        <label class="checkbox float-left">
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

        <div class="card-deck">
        <div class="card mb-4">
            <img class="card-img-top img-fluid" src="//placehold.it/500x280" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">1 Card title</h4>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card mb-4">
            <img class="card-img-top img-fluid" src="//placehold.it/500x280" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">2 Card title</h4>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"><!-- wrap every 2 on sm--></div>
        <div class="card mb-4">
            <img class="card-img-top img-fluid" src="//placehold.it/500x280" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">3 Card title</h4>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        </div>
    </body>
</html>
