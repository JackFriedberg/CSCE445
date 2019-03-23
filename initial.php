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

            $sql = "SELECT * FROM amrev_questions WHERE qIndex = " . strval($_SESSION["question"]);
            $questions = sqlsrv_query($conn, $sql);
            

            $sql = "SELECT * FROM amrev_options WHERE qIndex = " . strval($_SESSION["question"]);
            $options = sqlsrv_query($conn, $sql);
            
            $sql = "SELECT * FROM amrev_contect WHERE qIndex = " . strval($_SESSION["question"]);
            $context = sqlsrv_query($conn, $sql);
            
            if($questions){
                
                $row = sqlsrv_fetch_array($questions, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
            
                echo "Question 1 text: " . $row['QText']."<br />";    
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
            
            if($options){
                
                $row = sqlsrv_fetch_array($options, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
            
                echo "Answer 1 text: " . $row['Option1']."<br />";
                echo "Answer 2 text: " . $row['Option2']."<br />";    
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

            if($context){
           
                $row = sqlsrv_fetch_array($context, SQLSRV_FETCH_ASSOC); /*Grabs one row from fetch... removed the while loop */
            
                echo "Answer 1 text: " . $row['Embed']."<br />";
                echo "Answer 2 text: " . $row['Link']."<br />";    
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
            echo $_SESSION['question'];
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
            <input type="submit" name="answer1[]" id="answer1"><?php echo $_SESSION["answer1"] ?></button>
        </form>
        <form action="" method="post">
            <input type="submit" name="answer2[]" id="answer2">morning</button>
        </form>
        <?php
            $qty=$_POST['qty']; 
            if (is_array($qty))
                {
                    for ($i=0;$i<size($qty);$i++)
                        {
                            print ($qty[$i]);
                        }
                }
            function rightAnswer(){
                if($_SESSION["question"]%2==1){//if question is odd(2nd QText) and you got right answer
                    $_SESSION["question"]++;
                }
                else{
                    $_SESSION["question"]+2;
                }
            }
            function wrongAnswer(){
                if($_SESSION["question"]==1){
                    $_SESSION["question"]++;
                }
                else{
                    $_SESSION["question"]+2;
                }
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
