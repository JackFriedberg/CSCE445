<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");
?>

<html>
    <head>
        <title>My Account</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: url("https://img-aws.ehowcdn.com/877x500p/s3-us-west-1.amazonaws.com/contentlab.studiod/getty/f24b4a7bf9f24d1ba5f899339e6949f3");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .jumbotron {
                background-image: url("https://static1.squarespace.com/static/593edf2acd0f683cb1ef8c00/t/5a9c99c69140b7602db8cd13/1524006374262/sky-blue-white-83-351.jpg");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>
        
    <body>
        <div class="container">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="navbar-brand"><i class="fas fa-user"></i>My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Progress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link disabled" href="#"><?php  echo $_SESSION['UserId'];?></a>
                </li>
                <form action="/logout.php" method="POST">
                    <button type="submit" class="btn btn-primary btn-rounded">Logout</button>
                </form>
            </ul>
        </div>
        
        <div style="width: 50%">
            <div class="jumbotron text-center light-blue lighten-3 white-text">
                <h1>History: American Revolution</h1> <button type="submit" class="btn btn-outline-info btn-rounded waves-effect">Start<i class="fas fas fa-play pl-1"></i></button>
                <hr class="my-2">
            </div>

            <div class="jumbotron text-center light-blue lighten-3 white-text">
                <h1>Math: Trigonometry</h1>
                <hr class="my-2">
            </div>

            <div class="jumbotron text-center light-blue lighten-3 white-text">
                <h1>Fun Topics</h1>
                <hr class="my-2">
            </div>
        </div>
        
    </body>
</html>
