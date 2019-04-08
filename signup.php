<?php

include_once "../dbh.inc.php";
session_start();

if(isset($_POST['signup-submit'])){


    $username = $_POST['UserUid'];
    $email = $_POST['UserEmail'];
    $pwd = $_POST['UserPwd'];
    $pwd2 = $_POST['UserPwd2'];

    
    if(empty($username) || empty($email) || empty($pwd) || empty($pwd2)){ //form not filled out

        header("Location: /index.php?error=emptyfields&email=".$email."&uid=".$username);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){ //if its not a valid email AND not a valid username
        header("Location: /index.php?error=invalidemailuid");
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){ //if its not a valid email
        header("Location: /index.php?error=invalidemail&uid=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){ //if its  not a valid username
        header("Location: /index.php?error=invaliduid&email=".$email);
        exit();
    }
    else if($pwd !== $pwd2){ //if password don't match
        header("Location: /index.php?error=passwordCheck");
        exit();
    }
    else { 

        //prepare SQL statement to see if the username already exists
        $sqlCheck = "SELECT username FROM users WHERE username = ?";
        //put parameter in array
        $paramsCheck = array(&$username);
        //prepare the statement
        $preparedCheck = sqlsrv_prepare($conn, $sqlCheck, $paramsCheck, array( "Scrollable" => SQLSRV_CURSOR_CLIENT_BUFFERED));
        
        if(!$preparedCheck){
            //could't prepare the statement
            sqlsrv_free_stmt($preparedCheck);
            header("Location: /index.php?error=Checkpreparation");
            exit();
        }
        else {
            //execute the statement
            $result = sqlsrv_execute($preparedCheck);
            $rowBool = sqlsrv_has_rows($result);

            if(!$rowBool){
                sqlsrv_free_stmt($prepared);
                header("Location: /index.php?error=usernameTaken&email=".$email);
                exit();
            }
            else { //All error checking done 
                //prepare the sql statement
                $sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?)";
                //hash the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //put paramters in array
                $params = array(&$username, &$email, &$hashedPwd);
                
                //prepare the statement
                if(!$prepared = sqlsrv_prepare($conn, $sql, $params)){
                    //could't prepare the statement
                    sqlsrv_free_stmt($prepared);
                    header("Location: /index.php?error=preparation");
                    exit();
                }
                else {
                    //execute the statement
                    if(!sqlsrv_execute($prepared)){
                    //couldn't execute the statement 
                        sqlsrv_free_stmt($prepared);
                        header("Location: /index.php?error=execution");
                        exit();
                    }
                    else {
                        //SUCCESS - added a user
                        sqlsrv_free_stmt($prepared);
                        header("Location: /index.php?signup=success");
                        exit();
                    }
                }
            }
        }
    }
}
else {
    //didnt submit form
    header("Location: /index.php");
    exit();
}

?>