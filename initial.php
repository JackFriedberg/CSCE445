<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<?php
    chdir('..');
    include_once "dbh.inc.php";
    session_start();
?>
<style>
    .button {
	  display: block;
	  position: relative;
	  padding: 15px 25px;
	  font-size: 24px;
	  cursor: pointer;
	  text-align: center;
	  text-decoration: none;
	  outline: none;
	  color: #fff;
	  background-color: #4CAF50;
	  border: none;
	  border-radius: 15px;
	  box-shadow: 0 9px #999;
	}
	
	.button:hover {background-color: #3e8e41}
	
	.button:active {
	  background-color: #3e8e41;
	  box-shadow: 0 5px #666;
	  transform: translateY(4px);
	}
</style>

<html>
    <head>
        <title>UpQuiz</title>
    </head>
    <body>  

        <?php
            $sql = "SELECT * FROM Questions WHERE qIndex = " . strval($_SESSION["question"]);
                $test1 = sqlsrv_query($conn, $sql);
            
            if($_SESSION["questionState"]==1){
                
                $row = sqlsrv_fetch_array($test1, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
                            
                echo "Question 1 text: " . $row['qText1']."<br />";
                //echo "Question 2 text: " . $row['qText2']."<br />";    
                
                $question1Answers = explode(";", $row['answers1']); /* delimts the string into an array */
                $question2Answers = explode(";", $row['answers2']);
                
                echo "Answers for Question 1: <br />";
                foreach ($question1Answers as &$value1) { /* for loop goes length of array, stores curr value in $value1 */
                    if($_SESSION["iterator"]==1){
                        $_SESSION["answer1"]=$value1;
                        //todo: either change the schema for the database to have a certain number of answers only
                        // or finish rest of this to be able to add query answer choices to buttons
                    }
                    echo "----". $value1 . "<br />";
                }
                /*echo "Answers for Question 2: <br />";
                foreach ($question2Answers as &$value2) {
                    echo "----". $value2 . "<br />";
                }*/
                
                echo "Context 1 text: " . $row['context1_1']."<br />";
            }
            if($_SESSION["questionState"]==2){
                
                $row = sqlsrv_fetch_array($test1, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
                            
                //echo "Question 1 text: " . $row['qText1']."<br />";
                echo "Question 2 text: " . $row['qText2']."<br />";    
                
                $question1Answers = explode(";", $row['answers1']); /* delimts the string into an array */
                $question2Answers = explode(";", $row['answers2']);
                
                //echo "Answers for Question 1: <br />";
             //   foreach ($question1Answers as &$value1) { /* for loop goes length of array, stores curr value in $value1 */
                  //  if($_SESSION["iterator"]==1){
                   //     $_SESSION["answer1"]=$value1;
                        //todo: either change the schema for the database to have a certain number of answers only
                        // or finish rest of this to be able to add query answer choices to buttons
                   // }
                   // echo "----". $value1 . "<br />";
                //}
                echo "Answers for Question 2: <br />";
                foreach ($question2Answers as &$value2) {
                    if($_SESSION["iterator"]==1){
                        $_SESSION["answer1"]=$value2;
                        //todo: either change the schema for the database to have a certain number of answers only
                        // or finish rest of this to be able to add query answer choices to buttons
                    }
                    echo "----". $value2 . "<br />";
                }
                
                echo "Context 1 text: " . $row['context1_1']."<br />";
            }
            else{
                echo 'SQL Error:';
                if( ($errors = sqlsrv_errors() ) != null) {
                    foreach( $errors as $error ) {
                        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                        echo "code: ".$error[ 'code']."<br />";
                        echo "message: ".$error[ 'message']."<br />";
                    }
                }
            }
            sqlsrv_free_stmt($getResults); /* idk what this does */
            echo $_SESSION['questionState'];
            /*if($_SESSION['questionState']==1){
                $_SESSION['questionState']++;
            }
            else{
                $_SESSION['questionState']=1;
                $_SESSION['question']++; /* Increments the session variable after the query*/
            //}
            
        ?>

        <!--
        This is where answer selection needs to be validated.
        If the correct answer is chosen, the below button action should be 
        triggered, most likely with javascript (the user shouldnt have to push a button).
        If incorrect, the show/hide functionality needs to be implemented(Question 1 stuff 
        hidden, Question 2 stuff shown).
        -->
        
        <!--
            TODO: MAKE BUTTONS SHOW ALL OF THE ANSWER CHOICES
            ALSO ADD ONCLICK TO BUTTONS FOR PHP FUNCTIONS USING AJAX
            -->
        <form action="" method="post">
            <input type="submit" name="answer1" id="answer1"><?php echo $_SESSION["answer1"] ?></button>
        </form>
        <form action="" method="post">
            <input type="submit" name="answer2" id="answer2">morning</button>
        </form>
        <?php 
            function rightAnswer(){
                $_SESSION["question"]++;
                $_SESSION["questionState"]=1;
            }
            function wrongAnswer(){
                $_SESSION["questionState"]++;
            }
            if(array_key_exists('answer1',$_POST)){
                rightAnswer();
             }
            if(array_key_exists('answer2',$_POST)){
                wrongAnswer();
            }

        ?>

    </body>
</html>
