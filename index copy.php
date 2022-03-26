<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css" />
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_GET['invalid'])){
            echo "<p>Invalid Login, please try again</p>";
        }else if(isset($_GET['userExist'])){
            echo "<p>User already exist</p>";
        }
    ?>
    <!--LOGIN-->
    <form action="" method="POST" id="logIn">
        <h1>LOGIN</h1>
        <label for="userName">Username: </label><p><input type="text" name="userName"></p>
        <label for="password">Password: </label><p><input type="password" name="passw"></p>
        <button type="submit" name="logIn" id="submitBut">Submit</button>
    </form>
    <form action="" method="POST" id="signUp">
        <h1>SIGN UP</h1>
        <label for="userName">Username: </label><p><input type="text" name="userName"></p>
        <label for="password">Password: </label><p><input type="password" name="passw"></p>
        <label for="firstName">First Name: </label><p><input type="text" name="firstName"></p>
        <label for="lastName">Last Name: </label><p><input type="text" name="lastName"></p>
        <button type="submit" name="signUp" id="submitBut">Submit</button>
    </form>

    <?php
        include "manager.php";
        if(isset($_POST['logIn'])){
            $userID = getUserID($_POST['userName']);
            //there is currently a user in the database with that username AND the user entered correct credentials
            if($userID != '0' && successfullLogin($_POST['userName'], $_POST['passw'])){
                $_SESSION['USERID'] = $userID;
                header('location: main.php');
            }else{
                header('location: index.php?invalid');
            }
        }else if(isset($_POST['signUp'])){
            //check if there are not same username in the database
            if(getUserID($_POST['userName']) == '0'){
                addNewUser($_POST['userName'], $_POST['passw'], $_POST['firstName'], $_POST['lastName']);
                $_SESSION['USERID'] = getUserID($_POST['userName']);
                header('location: main.php');
            }else{
                header('location: index.php?userExist');
            }
        }
    ?>
</body>
</html>