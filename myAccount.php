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
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "My First Chart in CanvasJS"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "column",
			dataPoints: [
				{ label: "apple",  y: 10  },
				{ label: "orange", y: 15  },
				{ label: "banana", y: 25  },
				{ label: "mango",  y: 30  },
				{ label: "grape",  y: 28  }
			]
		}
		]
	});
	chart.render();
}
</script>
        <style>
            body {
                background-image: url("https://img-aws.ehowcdn.com/877x500p/s3-us-west-1.amazonaws.com/contentlab.studiod/getty/f24b4a7bf9f24d1ba5f899339e6949f3");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {
        
            var data = google.visualization.arrayToDataTable([
            ['Language', 'Rating'],
            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "['".$row['name']."', ".$row['rating']."],";
                }
            }
            ?>
            ]);
            
            var options = {
                title: 'Most Popular Social Media',
                width: 900,
                height: 500,
            };
            
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            
            chart.draw(data, options);
}
</script>
    </head>
    
    <body>
    <div id="chartContainer" style="height: 300px; width: 100%;">
    </div>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><i class="fas fa-user"></i>My Account</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="#">Saved Quizzes</a>
                        <a class="nav-item nav-link" href="#">Quiz Statistics</a>
                        <a class="nav-item nav-link disabled" href="#"><?php  echo $_SESSION['UserId'];?></a>
                        <form action="/logout.php" method="POST">
                            <button type="submit" class="btn btn-primary btn-rounded">Logout</button>
                        </form>
                    </div>  
                </div>
            </nav>
        </div>
        <h1> My Account Page! </h1>

        <h3> You are signed in as <?php  echo $_SESSION['UserId'];?></h3>
        <h1>QuizStats </h1>
        <div id="piechart"></div>
        <?php
            $username = strval($_SESSION['UserId']);
            $sql = "SELECT * FROM quizStats WHERE username LIKE "."'". $username ."'"; 
            $result = sqlsrv_query($conn,$sql);
            
            $overallVideoTotal = 0;
            $overallVideoCorrect = 0;
            $overallTextTotal = 0;
            $overallTextCorrect = 0;
            $universalTotal = 0;
            $universalCorrect = 0;
            
            if(sqlsrv_has_rows($result)){                
                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
    
                    $quizType= strval($row["quiztype"]);
                    
                    $textTotal = intval($row["texttotal"]);
                    $textCorrect = intval($row["textCorrect"]);
                    $textPercentage = $textCorrect / $textTotal * 100;
                    $videoTotal = intval($row["videototal"]);
                    $videoCorrect = intval($row["videoCorrect"]);
                    $videoPercentage = $videoCorrect / $videoTotal * 100;
                
                    $overallTotal = $textTotal + $videoTotal;
                    $overallCorrect = $textCorrect + $videoCorrect;
                    $overallPercentage = $overallCorrect / $overallTotal * 100;
                    $overallVideoTotal += $videoTotal;
                    $overallVideoCorrect += $videoCorrect;
                    $overallTextTotal += $textTotal;
                    $overallTextCorrect += $textCorrect;
                    $universalTotal += $overallTotal;
                    $universalCorrect += $overallCorrect;


                    echo '
                        <h3> ' . $quizType .' Quiz </h3>
                        <p> Total questions answered: ' . $overallTotal . '</p>
                        <p> Total questions correct: ' . $overallCorrect . '</p>
                        <p> Total question percentage: ' . $overallPercentage .'%</p>
                        <br>
                        <p> Text questions answered: ' . $textTotal . '</p>
                        <p> Text questions correct: ' . $textCorrect . '</p>
                        <p> Text question percentage: ' . $textPercentage .'%</p>
                        <br>
                        <p> Video questions answered: ' . $videoTotal . '</p>
                        <p> Video questions correct: ' . $videoCorrect . '</p>
                        <p> Video question percentage: ' . $videoPercentage .'%</p>
                        <br> </br>
                    ';
                }
            }
            $universalPercentage = $universalCorrect/$universalTotal * 100;
            $overallVideoPercentage = $overallVideoCorrect/$overallVideoTotal * 100;
            $overallTextPercentage = $overallTextCorrect/$overallTextTotal * 100;
            echo '
                <h3> All Quizes </h3>
                <p> Questions answered: ' .  $universalTotal . '</p>
                <p> Questions correct: ' . $universalCorrect . '</p>
                <p> Question percentage: ' . $universalPercentage .'%</p>
                <br>
                <p> Text questions answered: ' . $overallTextTotal . '</p>
                <p> Text questions correct: ' . $overallTextCorrect . '</p>
                <p> Text question percentage: ' . $overallTextPercentage .'%</p>
                <br>
                <p> Video questions answered: ' . $overallVideoTotal . '</p>
                <p> Video questions correct: ' . $overallVideoCorrect . '</p>
                <p> Video question percentage: ' . $overallVideoPercentage .'%</p>
                <br>
            ';
        ?>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </body>
</html>