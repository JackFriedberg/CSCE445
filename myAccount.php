<?php
    include_once "../dbh.inc.php";
    session_start();
    if(!isset($_SESSION['UserId']))
        header("Location: Index.php");


    $username = strval($_SESSION['UserId']);

    $sql = "SELECT * FROM quizStats WHERE username LIKE "."'". $username ."'"; 
    $result = sqlsrv_query($conn,$sql);
    
    $overallVideoTotal = 0;
    $overallVideoCorrect = 0;
    $overallTextTotal = 0;
    $overallTextCorrect = 0;
    $overallTotal = 0;
    $overallCorrect = 0;
    
    if(sqlsrv_has_rows($result)){                
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){

            $quizType= strval($row["quiztype"]);
            
            ${$quizType. "TextTotal"} = intval($row["texttotal"]);
            ${$quizType. "TextCorrect"} = intval($row["textCorrect"]);
            ${$quizType. "VideoTotal"} = intval($row["videototal"]);
            ${$quizType. "VideoCorrect"} = intval($row["videoCorrect"]);
            ${$quizType. "QuizTotal"} =  ${$quizType. "TextTotal"} + ${$quizType. "VideoTotal"};
            ${$quizType. "QuizCorrect"} = ${$quizType. "TextCorrect"} + ${$quizType. "VideoCorrect"};

            $overallVideoTotal += ${$quizType. "VideoTotal"};
            $overallVideoCorrect +=  ${$quizType. "VideoCorrect"};
            $overallTextTotal +=  ${$quizType. "TextTotal"};
            $overallTextCorrect +=  ${$quizType. "TextCorrect"};
            $universalTotal += ${$quizType. "QuizTotal"};
            $universalCorrect += ${$quizType. "QuizCorrect"};
        }
    }
    
    //Overall chart arrays
    $funTextData = array();
    $funVideoData = array();
    $funTotalData = array();



    if(!empty($amrevQuizTotal) ||  $amrevQuizTotal > 0){
        $amrevTextData = array(
            array("label" => "Correct", "y"=> $amrevTextCorrect),
            array("label" => "Incorrect", "y"=>($amrevTextTotal - $amrevTextCorrect))
        );
        $amrevVideoData = array(
            array("label" => "Correct", "y"=> $amrevVideoCorrect),
            array("label" => "Incorrect", "y"=>($amrevVideoTotal - $amrevVideoCorrect))
        );
        $amrevTotalData = array(
            array("label" => "Correct", "y"=> $amrevQuizCorrect),
            array("label" => "Incorrect", "y"=>($amrevQuizTotal - $amrevQuizCorrect))
        );
    }
    
    if(!empty($mathQuizTotal) ||  $mathQuizTotal > 0){
        $mathTextData = array(
            array("label" => "Correct", "y"=> $mathTextCorrect),
            array("label" => "Incorrect", "y"=>($mathTextTotal - $mathTextCorrect))
        );
        $mathVideoData = array(
            array("label" => "Correct", "y"=> $mathVideoCorrect),
            array("label" => "Incorrect", "y"=>($mathVideoTotal - $mathVideoCorrect))
        );
        $mathTotalData = array(
            array("label" => "Correct", "y"=> $mathQuizCorrect),
            array("label" => "Incorrect", "y"=>($mathQuizTotal - $mathQuizCorrect))
        );
    }
    
    
    if(!empty($funQuizTotal) ||  $funQuizTotal > 0){
        $funTextData = array(
            array("label" => "Correct", "y"=> $funTextCorrect),
            array("label" => "Incorrect", "y"=>($funTextTotal - $funTextCorrect))
        );
        $funVideoData = array(
            array("label" => "Correct", "y"=> $funVideoCorrect),
            array("label" => "Incorrect", "y"=>($funVideoTotal - $funVideoCorrect))
        );
        $funTotalData = array(
            array("label" => "Correct", "y"=> $funQuizCorrect),
            array("label" => "Incorrect", "y"=>($funQuizTotal - $funQuizCorrect))
        );
    }
    




    $sql_Amrev = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'AmRev'";
    $amRev_result = sqlsrv_query($conn,$sql_Amrev);
    if($amRev_result){
        $row = sqlsrv_fetch_array($amRev_result, SQLSRV_FETCH_ASSOC);
        //echo '<h3> Amrev Progress: ' . $row['questionNumber']  .'</h3>';
    }

    $sql_Math = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'math'";
    $math_result = sqlsrv_query($conn,$sql_Math);
    if($math_result){
        $row = sqlsrv_fetch_array($math_result, SQLSRV_FETCH_ASSOC);
        //echo '<h3> Math Progress: ' . $row['questionNumber']  .'</h3>';
    }

    
?>


<html>
    <head>
        <title>My Account</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <style>
            body {
                background-image: url("https://img-aws.ehowcdn.com/877x500p/s3-us-west-1.amazonaws.com/contentlab.studiod/getty/f24b4a7bf9f24d1ba5f899339e6949f3");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .jumbotron {
                background-image: url("https://t4.ftcdn.net/jpg/01/08/25/95/240_F_108259589_cRwIo0e1RmYE4HIp2217gXXyJByB9ozb.jpg");
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

        <!--   Start Divs for quizzes -->
<!--        
        <div class="container" style="max-height: 30%; width: 50%;">
            <div class="jumbotron text-center light-blue lighten-3 white-text mx-2 mb-5">
                <h1>History: American Revolution</h1>
                <button type="submit" class="btn btn-dark btn-rounded">Start<i class="fas fas fa-play pl-1"></i></button>
                <hr class="my-2">
            </div>
        </div>
-->
        <div class="jumbotron mx-auto mb-5" style="height: 25%; width: 50%; overflow:hidden;" id="mathJumbo">
            <div class="container" style="width: 70%; display:inline-block; float:left" id="mathHeader" >
                <div>
                    <h1>Math: Trigonometry</h1>
                </div>
                <div>
                    <div class="progress" style="display:inline-block; float:left; width:75%; margin: auto">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                            70%
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-rounded" style="display:inline-block; float:left; width:20%">Start<i class="fas fas fa-play pl-1"></i></button>
                </div>
            </div>
            <div class="container" style="width: 30%; display:inline-block; float:left " id="mathTotal">
                <div style="height:100%; width:95%; display:inline-block; float:left" id="mathTotalChartContainer">
                </div>
                <div cclass= "align-middle" style="height:100%; width:5%;display:inline-block; float:left">
                    <button onclick="expandMathStats()"><i id="mathIcon" class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
            <div class="container" style="width: 0%;display:inline-block; float:left; visibility: hidden;" id="mathBreakout">
                <div style="height:100%; width:50%; display:inline-block; float:left" id="mathTextChartContainer">
                </div>
                <div style="height:100%; width:50%; display:inline-block; float:left" id="mathVideoChartContainer">
                </div>
            </div>
        </div>

<!--
        <div class="container" style="max-height: 30%;width: 50%;">
            <div class="jumbotron text-center light-blue lighten-3 white-text mx-2 mb-5">
                <h1>Swag: Fun Topics</h1>
                <button type="submit" class="btn btn-dark btn-rounded">Start<i class="fas fas fa-play pl-1"></i></button>
                <hr class="my-2">
            </div>
        </div>
-->


    </body>


    <script>
        window.onload = function () {
            //for loop here 
            var chart = new CanvasJS.Chart("mathTotalChartContainer", {
                backgroundColor: "transparent",
                animationEnabled: true,
                exportEnabled: false,
                title:{
                    text: "Overall Quiz Performace",
                    fontColor: "white",
                    fontSize: 16,
                    fontWeight: "normal"
                },
                data: [{
                    type: "pie",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 12,
                    indexLabelFontColor: "white",
                    indexLabelPlacement: "inside",
                    indexLabel: "#percent%",

                    dataPoints: <?php echo json_encode($mathTotalData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            chart.render();
        }

        function expandMathStats(){

            if(document.getElementById("mathBreakout").style.visibility == "visible"){
                document.getElementById("mathJumbo").style.width = "50%";
                document.getElementById("mathHeader").style.width = "70%";
                document.getElementById("mathTotal").style.width = "30%";
                document.getElementById("mathBreakout").style.width = "0%";
                document.getElementById("mathBreakout").style.visibility = "hidden";
                document.getElementById("mathIcon").classList.remove('fa-angle-double-left');
                document.getElementById("mathIcon").classList.add('fa-angle-double-right');
            }
            else{
                document.getElementById("mathJumbo").style.width = "90%";
                document.getElementById("mathHeader").style.width = "40%";
                document.getElementById("mathTotal").style.width = "20%";
                document.getElementById("mathBreakout").style.width = "40%";
                document.getElementById("mathBreakout").style.visibility = "visible";
                document.getElementById("mathIcon").classList.remove('fa-angle-double-right');
                document.getElementById("mathIcon").classList.add('fa-angle-double-left');
                breakoutMathCharts();
            }

        }   


        function breakoutMathCharts () {
            //for loop here 
            var textChart = new CanvasJS.Chart("mathTextChartContainer", {
                backgroundColor: "transparent",
                animationEnabled: true,
                exportEnabled: false,
                title:{
                    text: "Text Based Question Performace",
                    fontColor: "white",
                    fontSize: 16,
                    fontWeight: "normal"
                },
                data: [{
                    type: "pie",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 12,
                    indexLabelFontColor: "white",
                    indexLabelPlacement: "inside",
                    indexLabel: "#percent%",

                    dataPoints: <?php echo json_encode($amrevTextData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            textChart.render();

            var videoChart = new CanvasJS.Chart("mathVideoChartContainer", {
                backgroundColor: "transparent",
                animationEnabled: true,
                exportEnabled: false,
                title:{
                    text: "Video Based Question Performace",
                    fontColor: "white",
                    fontSize: 16,
                    fontWeight: "normal"
                },
                data: [{
                    type: "pie",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 12,
                    indexLabelFontColor: "white",
                    indexLabelPlacement: "inside",
                    indexLabel: "#percent%",

                    dataPoints: <?php echo json_encode($amrevVideoData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            videoChart.render();
        }
    </script>
</html>

