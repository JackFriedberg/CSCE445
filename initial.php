<?php
    include_once "../dbh.inc.php";
    session_start();

    $validate;

    if(!empty($_GET['quizType']))
        $_SESSION['quizType'] = $_GET['quizType'];

    if(!isset($_SESSION['quizType'])){
        header("Location: index.php?invalidQuiz");
    }

    if(!empty($_GET['answer']))
        $validate = $_GET['answer'];
?>

<html>
    <head>
        <title>UpQuiz</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <?php
    if(!isset($_SESSION['question']) || $_SESSION['question'] == 0 ){
        if(isset($_SESSION['UserId'])){
            //show menu
            echo'
            <body style="height:100%; margin:0; padding:0"> 
                <div class="container">
                <div class = "jumbotron text-center">
                    <h1> "Select what type of context you want" </h1>
                </div>
                <div class="row align-items-center justify-content-center">
                    <form action="handle.php" method="post">
                        <div id="menuDiv" class="btn-group-vertical" style="margin:0 auto">
                            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="video"> Video Context </button>
                            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="text"> Text Context </button>
                            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="random"> Randomized Context </button>
                        </div>
                    </form>
                </div>
            ';
        }
        else {
            $_SESSION['questionType'] = "random";    
            $_SESSION['question'] = 1;
            header("Location: initial.php");
        }
    }
    else if(!isset($_SESSION['questionType'])){
        echo'
            <body style="height:100%; margin:0; padding:0"> 
                <div class="container">
                <div class = "jumbotron text-center">
                    <h1> "Select what type of context you want" </h1>
                </div>
                <div class="row align-items-center justify-content-center">
                    <form action="handle.php" method="post">
                        <div id="menuDiv" class="btn-group-vertical" style="margin:0 auto">
                            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="video"> Video Context </button>
                            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="text"> Text Context </button>
                            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="random"> Randomized Context </button>
                        </div>
                    </form>
                </div>
            ';
    }
    else{

        if( strval($_SESSION['questionType']) == "random"){
            if(rand(0,1) == 0){
                $_SESSION['tempQuestionType'] = "text";
            }
            else{
                $_SESSION['tempQuestionType'] = "video";
            }
        }
        else {
            $_SESSION['tempQuestionType'] = $_SESSION['questionType'];
        }

        //updates SQL database for what question the user is on




        //picks what table to get questions/options/etc from
        $sqlQuizString = $_SESSION['quizType'] . "_" .   $_SESSION['tempQuestionType'] . "_";

        //creates SQL queries
        $questionQuery = "SELECT * FROM ". $sqlQuizString ."questions WHERE qIndex = " . strval($_SESSION['question']);
        $optionsQuery =  "SELECT * FROM ". $sqlQuizString ."options WHERE qIndex = "   . strval($_SESSION['question']);
        $contextQuery =  "SELECT * FROM ". $sqlQuizString ."context WHERE qIndex = "   . strval($_SESSION['question']);

        //queries tavbles for question/option/context
        $questions = sqlsrv_query($conn, $questionQuery);
        $options =   sqlsrv_query($conn, $optionsQuery);
        $context =   sqlsrv_query($conn, $contextQuery);

        //prints error if theres a problem
        if(!$questions || !$options || !$context){
            echo 'SQL Error:';
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
        }

        //gets all the info the page needs
        $row = sqlsrv_fetch_array($questions, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
        $questionText = $row['QText'];
        $qIndex = $row['QIndex'];

        $row = sqlsrv_fetch_array($options, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
        $option1 = $row['Option1'];
        $option2 = $row['Option2'];
        $option3 = $row['Option3'];
        $option4 = $row['Option4'];
        $answer = $row['Answer'];
                
        if($option1 == $answer){
            $correct = $option1;
            $incorrect1 = $option2;
            $incorrect2 = $option3;
            $incorrect3 = $option4;
        }
        else if($option2 == $answer){
            $correct = $option2;
            $incorrect1 = $option1;
            $incorrect2 = $option3;
            $incorrect3 = $option4;
        }
        else if($option3 == $answer){
            $correct = $option3;
            $incorrect1 = $option2;
            $incorrect2 = $option1;
            $incorrect3 = $option4;
        }
        else if($option4 == $answer){
            $correct = $option4;
            $incorrect1 = $option2;
            $incorrect2 = $option3;
            $incorrect3 = $option1;
        }

        $counter = 1;
        $contextEmbedArray = array();
        $contextLinkArray = array();
        while($row = sqlsrv_fetch_array($context, SQLSRV_FETCH_ASSOC)){
            array_push($contextEmbedArray, $row['Embed']);
            array_push($contextLinkArray, $row['Link']);
            $counter++;
        }

        //start filling in the page w HTML
       
        echo '
            <body style="height:100%; margin:0; padding:0"> 
                <div class="container">
                    <div class="jumbotron text-center">
                        <h1>' . $questionText . '</h1>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <form id= "theForm" action="handle.php" method="post">
                            <div id="buttonDiv" class="btn-group-vertical" style="margin:0 auto">
                                <button type="submit" class="btn btn-outline-primary btn-rounded" name="correct"> <h3>' . $correct . '</h3></button>
                                <button type="submit" class= "btn btn-outline-primary btn-rounded" name="incorrect1"> <h3>' . $incorrect1 . '</h3></button>
                                <button type="submit" class= "btn btn-outline-primary btn-rounded" name="incorrect2"> <h3>' . $incorrect2 . '</h3></button>
                                <button type="submit" class= "btn btn-outline-primary btn-rounded" name="incorrect3"> <h3>' . $incorrect3 . '</h3></button>
                            </div>
                        </form>
                    </div>
                    <div id="historicalContainer" class="row" style="max-height:100%">
        ';
        for($i = 1; $i < $counter; $i++){
        echo '
                        <button type="button" class="btn btn-primary btn-floating col-md-3 center-block" data-toggle="modal" data-target="#contextModal'. $i .'">Click for context # ' . strval($i) . '</button>
                            <blockquote class="blockquote">
                                <div id="contextModal'. $i .'" class="modal fade" role="dialog" align="center">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <p>' . $contextEmbedArray[$i - 1] . '</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </blockquote>
                        </button>
        ';
        }
        echo        '</div>';
        if($validate == "correct"){
            echo '
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Correct!</strong> Good Job!
                    </div>
                ';
        }
        if($validate == "incorrect"){
            echo '
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Incorrect!</strong> Try this one.
                    </div>
            ';
        }
        
        if(isset($_SESSION['UserId'])){ //add buttons to return to MyAccount or Logout if the user is logged in 
            echo '
                    <div class="container">
                        <hr class="my-2">
                        <hr class="my-2">
                        <div class="jumbotron text-center">
                            <form action="/myAccount.php" method="POST">
                                <button type="submit" class="btn btn-dark">My Account<i class="fas fas fa-sign-in-alt pl-1"></i></button>
                            </form>
                            <form action="/logout.php" method="POST">
                                <button type="submit" class="btn btn-dark">Logout<i class="fas fas fa-sign-in-alt pl-1"></i></button>
                            </form>    
                        </div>
                        <hr class="my-2">
                        <hr class="my-2">
                    </div>';
        }
        else {
            echo '
                    <div class="container">
                        <hr class="my-2">
                        <hr class="my-2">
                        <div class="jumbotron text-center">
                            <form action="index.php" method="POST">
                                <button type="submit" class="btn btn-dark">Home Page<i class="fas fas fa-sign-in-alt pl-1"></i></button>
                            </form> 
                        </div>
                        <hr class="my-2">
                        <hr class="my-2">
                    </div>';
        }
        echo '
                </div>
            </body>
        ';
    }
    ?>

    <script>
        var form = document.getElementById("theForm");
        for (var i = form.children.length; i >= 0; i--) {
            form.appendChild(form.children[Math.random() * i | 0]);
        }
    </script>
</html>
