<?php

include_once "../dbh.inc.php";
session_start();

if(isset($_POST['signup-submit'])){

    $username = $_POST['Username'];
    $password = $_POST['UserPwd'];

    if(empty($username) || empty($password)){
        header("Location: index.php?error=emptyfields&Username=".$username)
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE username = ?";

        $params = array(&$username);


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
            else { //got the results
                $result = sqlsrv_fetch_array($prepared);
                if($row = sqlsrv_fetch_array($context)){
                    $pwdCheck = password_verify($password, $row['pwd']);
                    if($pwdCheck == false){
                        header("Location: /index.php?error=WrongPassword");
                        exit();    
                    }
                    else if($pwdCheck == true){
                        $_SESSION['UserId'] = $row['username'];
                        header("Location: /index.php");
                    }
                    else{
                        header("Location: /index.php?error=LoginSystemError");
                        exit();    
                    }
                }
                else{
                    header("Location: /index.php?error=NoUser");
                    exit();
                }



                sqlsrv_free_stmt($prepared);
                header("Location: /index.php?login=success");
                exit();
            }
        }
    }

}
else{
    header("Location: index.php");
    exit();
}