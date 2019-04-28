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
    

    $amrevProgress = 0;
    $mathProgress = 0;
    $funProgress = 0;
    

    $sql_Amrev = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'AmRev'";
    $amRev_result = sqlsrv_query($conn,$sql_Amrev);
    if($amRev_result){
        $row = sqlsrv_fetch_array($amRev_result, SQLSRV_FETCH_ASSOC);
        $amrevProgress =  intval($row['questionNumber']);
    }

    $sql_Math = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'math'";
    $math_result = sqlsrv_query($conn,$sql_Math);
    if($math_result){
        $row = sqlsrv_fetch_array($math_result, SQLSRV_FETCH_ASSOC);
        $mathProgress =  intval($row['questionNumber']);
    }

    $sql_Fun = "SELECT * FROM quizProgress WHERE username LIKE "."'". $_SESSION['UserId'] ."'". " AND  QuizType LIKE 'fun'";
    $fun_result = sqlsrv_query($conn,$sql_Fun);
    if($fun_result){
        $row = sqlsrv_fetch_array($fun_result, SQLSRV_FETCH_ASSOC);
        $funProgress =  intval($row['questionNumber']);
    }

    //set these manually
    $amRevTotalQuestions = 38;
    $mathTotalQuestions = 10;
    $funTotalQuestions = 10;

    //calculate the percentages
    $amrevPercent = $amrevProgress/$amRevTotalQuestions * 100;
    $mathPercent = $mathProgress/$mathTotalQuestions * 100;
    $funPercent = $funProgress/$funTotalQuestions * 100;

    //round the calculation to one decimal
    $amrevPercent = floor($amrevPercent * 10) / 10;
    $mathPercent = floor($mathPercent * 10) / 10;
    $funPercent = floor($funPercent * 10) / 10;
?>

                <!-- START HTML CODE -->
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

       <div class="jumbotron mx-auto mb-5" style="height: 25%; width: 50%; overflow:hidden;" id="amrevJumbo">
            <div class="container" style="width: 70%; display:inline-block; float:left" id="amrevHeader" >
                <div>
                    <h1>History: American Revolution</h1>
                </div>
                <div>
                    <div class="progress" style="display:inline-block; float:left; width:75%; margin: auto">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $amrevPercent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $amrevPercent;?>%">
                            <?php echo $amrevPercent . "%";?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-rounded" style="display:inline-block; float:left; width:20%">Start<i class="fas fas fa-play pl-1"></i></button>
                </div>
            </div>
            <div class="container" style="width: 30%; display:inline-block; float:left " id="amrevTotal">
                <div style="height:100%; width:95%; display:inline-block; float:left" id="amrevTotalChartContainer">
                </div>
                <div cclass= "align-middle" style="height:100%; width:5%;display:inline-block; float:left">
                    <button onclick="expandAmrevStats()"><i id="amrevIcon" class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
            <div class="container" style="width: 0%;display:inline-block; float:left; visibility: hidden;" id="amrevBreakout">
                <div style="height:100%; width:50%; display:inline-block; float:left" id="amrevTextChartContainer">
                </div>
                <div style="height:100%; width:50%; display:inline-block; float:left" id="amrevVideoChartContainer">
                </div>
            </div>
        </div>


        <div class="jumbotron mx-auto mb-5" style="height: 25%; width: 50%; overflow:hidden;" id="mathJumbo">
            <div class="container" style="width: 70%; display:inline-block; float:left" id="mathHeader" >
                <div>
                    <h1>Math: Trigonometry</h1>
                </div>
                <div>
                    <div class="progress" style="display:inline-block; float:left; width:75%; margin: auto">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $mathPercent;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $mathPercent;?>%">
                            <?php echo $mathPercent . "%";?>
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



        <div class="jumbotron mx-auto mb-5" style="height: 25%; width: 50%; overflow:hidden;" id="funJumbo">
            <div class="container" style="width: 70%; display:inline-block; float:left" id="funHeader" >
                <div>
                    <h1>Swag: Fun Topics</h1>
                </div>
                <div>
                    <div class="progress" style="display:inline-block; float:left; width:75%; margin: auto">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $funPercent;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $funPercent;?>%">
                            <?php echo $funPercent . "%";?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-rounded" style="display:inline-block; float:left; width:20%">Start<i class="fas fas fa-play pl-1"></i></button>
                </div>
            </div>
            <div class="container" style="width: 30%; display:inline-block; float:left " id="funTotal">
                <div style="height:100%; width:95%; display:inline-block; float:left" id="funTotalChartContainer">
                </div>
                <div cclass= "align-middle" style="height:100%; width:5%;display:inline-block; float:left">
                    <button onclick="expandFunStats()"><i id="funIcon" class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
            <div class="container" style="width: 0%;display:inline-block; float:left; visibility: hidden;" id="funBreakout">
                <div style="height:100%; width:50%; display:inline-block; float:left" id="funTextChartContainer">
                </div>
                <div style="height:100%; width:50%; display:inline-block; float:left" id="funVideoChartContainer">
                </div>
            </div>
        </div>


    </body>


                <!-- BEGIN JAVASCRIPT WORK -->
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("amrevTotalChartContainer", {
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

                    dataPoints: <?php echo json_encode($amrevTotalData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            chart.render();
            
             
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

            var chart = new CanvasJS.Chart("funTotalChartContainer", {
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

                    dataPoints: <?php echo json_encode($funTotalData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            chart.render();



        }

        function expandAmrevStats(){
            if(document.getElementById("amrevBreakout").style.visibility == "visible"){
                document.getElementById("amrevJumbo").style.width = "50%";
                document.getElementById("amrevHeader").style.width = "70%";
                document.getElementById("amrevTotal").style.width = "30%";
                document.getElementById("amrevBreakout").style.width = "0%";
                document.getElementById("amrevBreakout").style.visibility = "hidden";
                document.getElementById("amrevIcon").classList.remove('fa-angle-double-left');
                document.getElementById("amrevIcon").classList.add('fa-angle-double-right');
            }
            else{
                document.getElementById("amrevJumbo").style.width = "90%";
                document.getElementById("amrevHeader").style.width = "40%";
                document.getElementById("amrevTotal").style.width = "20%";
                document.getElementById("amrevBreakout").style.width = "40%";
                document.getElementById("amrevBreakout").style.visibility = "visible";
                document.getElementById("amrevIcon").classList.remove('fa-angle-double-right');
                document.getElementById("amrevIcon").classList.add('fa-angle-double-left');
                breakoutAmrevCharts();
            }
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

        function expandFunStats(){
            if(document.getElementById("funBreakout").style.visibility == "visible"){
                document.getElementById("funJumbo").style.width = "50%";
                document.getElementById("funHeader").style.width = "70%";
                document.getElementById("funTotal").style.width = "30%";
                document.getElementById("funBreakout").style.width = "0%";
                document.getElementById("funBreakout").style.visibility = "hidden";
                document.getElementById("funIcon").classList.remove('fa-angle-double-left');
                document.getElementById("funIcon").classList.add('fa-angle-double-right');
            }
            else{
                document.getElementById("funJumbo").style.width = "90%";
                document.getElementById("funHeader").style.width = "40%";
                document.getElementById("funTotal").style.width = "20%";
                document.getElementById("funBreakout").style.width = "40%";
                document.getElementById("funBreakout").style.visibility = "visible";
                document.getElementById("funIcon").classList.remove('fa-angle-double-right');
                document.getElementById("funIcon").classList.add('fa-angle-double-left');
                breakoutFunCharts();
            }
        }


        function breakoutAmrevCharts () {
            //for loop here 
            var textChart = new CanvasJS.Chart("amrevTextChartContainer", {
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

            var videoChart = new CanvasJS.Chart("amrevVideoChartContainer", {
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

                    dataPoints: <?php echo json_encode($mathTextData, JSON_NUMERIC_CHECK); ?>
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

                    dataPoints: <?php echo json_encode($mathVideoData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            videoChart.render();
        }


        function breakoutFunCharts () {
            //for loop here 
            var textChart = new CanvasJS.Chart("funTextChartContainer", {
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

                    dataPoints: <?php echo json_encode($funTextData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            textChart.render();

            var videoChart = new CanvasJS.Chart("funVideoChartContainer", {
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

                    dataPoints: <?php echo json_encode($funVideoData, JSON_NUMERIC_CHECK); ?>
                }],
                legend : {
                    fontColor: "white",
                }
            });
            videoChart.render();
        }
    </script>
</html>

