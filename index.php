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
							
		<!-- modal body -->
						<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                    </div>
					
                    <a href="#register" class="float-right">Create an account </a>
                </div>
            </div> 
        </div>
		
		<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create Account
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Create Account</button>
      </div>
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
                            <button type="submit" class="btn btn-primary"> Start Quiz </button>
                        </div>
                    </div>

                    <form action="/initial.php" method="POST">
                        <div class="card mb-4" style="max-width:310px">
                            <img class="card-img-top img-fluid" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">History</h4>
                                <p class="card-text">Want to learn more about America's past? Go through the journey with the American Revolution quiz and learn everything in a timeline fashion.</p>
                                <button type="submit" class="btn btn-primary"> Start Quiz </button>
                            </div>
                        </div>
                    </form>
                
                    <div class="card mb-4" style="max-width:310px">
                        <img class="card-img-top img-fluid" src="https://mdbootstrap.com/img/Photos/Others/photo6.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Topic 3</h4>
                            <p class="card-text">Swag</p>
                            <button type="submit" class="btn btn-primary"> Start Quiz </button>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
