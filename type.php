<?php
    include_once "../dbh.inc.php";
    session_start();
    
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
    <body>


<?php
    echo'
        <div style="height:100%" class="align-middle">
            <button type="button" class="btn btn-primary btn-floating col-md-3 center" onclick="setVideo()"> Video Context </button>
            <button type="button" class="btn btn-primary btn-floating col-md-3 center" onclick="setText()"> Text Context </button>
            <button type="button" class="btn btn-primary btn-floating col-md-3 center" onclick="setRandom()"> Randomized Context </button>
        </div>
    ';



?>

<script>
setVideo(){
    $_SESSION['questionType'] = "video";
    window.location.href = "initial.php";
}
setText(){
    $_SESSION['questionType'] = "text";
    window.location.href = "initial.php";
}
setRandom(){
    $_SESSION['questionType'] = "random";
    window.location.href = "initial.php";
}
</script>

</body>