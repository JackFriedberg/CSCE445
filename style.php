<?php
header("Content-type: text/css; charset: UTF-8");
$body_bg = "red";//"#DBF5F3";
$box_bg = "blue";//"#DBF5F3";
?>

body{
    background-color: <?php echo $body_bg; ?>;
}

box{
    position: absolute; 
    background-color: <?php echo $box_bg; ?>;
    border-radius: 15px;
    top: 100px;
    width: 400px;
    height: 300px; 
    left: 60px; 
    line-height: 18px; 
    padding-left: 15px; 
    padding-right: 12px; 
}