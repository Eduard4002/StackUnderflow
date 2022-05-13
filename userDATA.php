<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER DATA</title>
</head>
<body>
    <main>
    <?php
        include "manager.php";
        $pageName = $_POST['pageName'];
        //user wants to login
        if(isset($_POST['logIn'])){
        
            //getUserID by username
            $userID = getUserID($_POST['userName']);
            //check if user exists
            
            //check if password and username match
            if(successfullLogin($_POST['userName'], $_POST['passw']) && $userID != 0){
                //there is currently a user in the database with that username AND the user entered correct credentials
                $_SESSION['USER'] = getUserID($_POST['userName']);
                header('location: '.$pageName);
            }else{
                header('location: '.$pageName.'?invalidLog');
            }
            
        //user wants to sign up
        }else if(isset($_POST['signUp'])){
            //check if there are any users with the same username
            if(getUserID($_POST['userName']) == 0){
                //add the user to the database
                addNewUser($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['userName'],$_POST['passw'],$_POST['SQ1'],$_POST['SQVAL1'],$_POST['SQ2'],$_POST['SQVAL2']);
                $_SESSION['USER'] = getUserID($_POST['userName']);
                header('location:' .$pageName.'?succ');
            }else{
                header('location: '.$pageName.'?userExists');
            }
            
            
        //user wants to post a question
        }else if(isset($_POST['postQ'])){
            //check if user is logged in
            if((isset($_SESSION['USER']))){
                //add the question to the database
                addQuestion($_POST['title'],$_POST['body'],$_SESSION['USER']);
                header('location: index.php');
            }else{
                header('location: index.php?notLoggedIn');
            }
        //user wants to post a reply
        }else if(isset($_POST['postA'])){
            //check if user is logged in
            if(isset($_SESSION['USER'])){
                //add the reply to the database
                addReply($_POST['body'],$_POST['questionID'],$_SESSION['USER']);
                header('location: '.$pageName.'?ID='.$_POST['questionID']);
            }else{
                header('location: '.$pageName.'?notLoggedIn');
            }

        //user who posted the question wants to mark a reply as answer
        }else if(isset($_POST['markA'])){
            //check if user is logged in
            if(isset($_SESSION['USER'])){
                //mark the reply as the answer
                markAnswer($_GET['ansID']);
                header('location: '.$pageName.'?ID='.$_POST['questionID']);
            }else{
                header('location: '.$pageName.'?notLoggedIn');
            }

            
        //user who posted a reply wants to delete it
        }else if(isset($_POST['delRep'])){
            //delete the reply
            deleteReply($_GET['repID']);
            header('location: '.$pageName.'?ID='.$_POST['questionID']);
        //user wants to change his/her password
        }else if(isset($_POST['changPassw'])){
            $passw = $_POST['passw'];
            $confPassw = $_POST['confPassw'];
            //if passwords match
            if($passw != $confPassw){
                header('location: '.$pageName.'?passwNotMatch');
            //if security questions match
            }if(checkSecQuestions($_POST['userName'],$_POST['SQ1'],$_POST['SQVAL1'],$_POST['SQ2'],$_POST['SQVAL2'])){
                updatePassword($_POST['userName'],$_POST['passw']);
                header('location: '.$pageName.'?passwChanged');
            }else{
                header('location: '.$pageName.'?wrongSecQ');
            }
            

        }
        //user wants to logout
        if(isset($_GET['logout'])){
            //logout the user
            session_destroy();
            header('location: index.php');
        }  
    ?>
        
    </main>
</body>
</html>