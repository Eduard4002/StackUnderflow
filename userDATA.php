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

        if(isset($_POST['logIn'])){
            $userID = getUserID($_POST['userName']);
            //there is currently a user in the database with that username AND the user entered correct credentials
            if($userID != '0' && successfullLogin($_POST['userName'], $_POST['passw'])){
                $_SESSION['USER'] = $userID;
                header('location: '.$pageName);
            }else{
                header('location: '.$pageName.'?invalid');
            }
        }else if(isset($_POST['signUp'])){
            //check if there are not same username in the database
            if(getUserID($_POST['userName']) == '0'){
                addNewUser($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['userName'],$_POST['passw'],$_POST['SQ1'],$_POST['SQVAL1'],$_POST['SQ2'],$_POST['SQVAL2']);
                $_SESSION['USER'] = getUserID($_POST['userName']);
                header('location:' .$pageName.'?succ');
            }else{
                header('location: '.$pageName.'?userExists');
            }
        }else if(isset($_POST['postQ'])){
            if(isset($_SESSION['USER'])){
                addQuestion($_POST['title'],$_POST['body'],$_SESSION['USER']);
                header('location: '.$pageName);
            }else{
                header('location: '.$pageName.'?notLoggedIn');
            }
        }
        if(isset($_GET['logout'])){
            session_destroy();
            header('location: index.php');
        }  
    ?>
        
    </main>
</body>
</html>