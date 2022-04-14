<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navStyle.css">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Login/Sign Up</title>
</head>
<body>
    <main>
    <nav>
        <p id="title">stack<b>underflow</b></p>
    </nav>
    <div id="mainDiv">
     <!--LOGIN-->
     <form action="" method="POST" id="logIn">
        <h1>LOGIN</h1>
        <?php
            if(isset($_GET['invalid'])){
                echo "<p class='invalidText'>Invalid login, please try again</p>";
            }
        ?> 
        <label for="userName">Username: </label><p><input type="text" name="userName" <?php if(isset($_GET['invalid'])) {echo "class='invalidLogin'";}?>></p>
        <label for="password">Password: </label><p><input type="password" name="passw" <?php if(isset($_GET['invalid'])) {echo "class='invalidLogin'";}?>></p>
        <button type="submit" name="logIn" id="submitBut">Submit</button>
    </form>
    <!--SIGNUP-->
    <form action="" method="POST" id="signUp">
        <h1>SIGN UP</h1>
        <label for="firstName" required>Full Name: </label><input type="text" name="firstName" placeholder="First Name"><input type="text" name="lastName" placeholder="Last Name"><br>
        <label for="email" required>Email: </label><p><input type="email" name="email"></p>
        <label for="userName" required>Username: </label><p><input type="text" name="userName"></p>
        <label for="password" required>Password: </label><p><input type="password" name="passw"></p>
        <label for="SQ1" required>Security Question 1: </label>
        <select name="SQ1">
            <option value="1" selected>What was your favorite subject in high school?</option>
            <option value="2">What is the name of your first pet?</option>
            <option value="3">What is the name of the town where you were born?</option>
            <option value="4">What was the first company that you worked for?</option>
        </select>
        <input type="text" name="SQVAL1" required><br>
        <label for="SQ2">Security Question 2: </label>
        <select name="SQ2" required>
            <option value="1" selected>What was your favorite subject in high school?</option>
            <option value="2">What is the name of your first pet?</option>
            <option value="3">What is the name of the town where you were born?</option>
            <option value="4">What was the first company that you worked for?</option>
        </select>
        <input type="text" name="SQVAL2" required><br>
        <button type="submit" name="signUp" id="submitBut">Submit</button>
    </form>
        </div>
    <?php
        include "manager.php";
        if(isset($_POST['logIn'])){
            $userID = getUserID($_POST['userName']);
            //there is currently a user in the database with that username AND the user entered correct credentials
            if($userID != '0' && successfullLogin($_POST['userName'], $_POST['passw'])){
                $_SESSION['USER'] = $userID;
                header('location: index.php');
            }else{
                header('location: login.php?invalid');
            }
        }else if(isset($_POST['signUp'])){
            //check if there are not same username in the database
            if(getUserID($_POST['userName']) == '0'){
                addNewUser($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['userName'],$_POST['passw'],$_POST['SQ1'],$_POST['SQVAL1'],$_POST['SQ2'],$_POST['SQVAL2']);
                $_SESSION['USER'] = getUserID($_POST['userName']);
                header('location: index.php');
            }else{
                header('location:login.php?userExists');
            }
        }
    ?>
    </main>
</body>
</html>