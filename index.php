<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <link rel="stylesheet" href="CSS/navStyle.css">
    <script src="JS/loginSignUpButton.js"></script>
    <title>Home</title>
</head>
<body>
    
    <main>
        <nav>
            <p id="title">stack<b>underflow</b></p>
            <div id="navButtons">
                <?php
                    if(isset($_SESSION['USER'])){
                        echo '<button onclick="logout()">LogOut</button>';
                    }else{
                        echo '
                        <button onclick="openLoginModal()">Login</button>
                        <button onclick="openSignUpModal()">Sign Up</button>';
                    }
                ?>
            </div>
            
            
        </nav>
        
        <h2 id="topQuestionsTitle">Top Questions</h3>

        <a href="askQuestion.php"><button class="askButton">Ask A question</button></a>
        
        <!--Main question div-->
        <div class="questionsGrid">
            <div class="questionsChild">
            </div>
            <div class="questionsChild">
            </div>
            <div class="questionsChild">
            </div>
            <div class="questionsChild">
            </div>
        </div>



    </main>



    <!---LOGIN AND SIGNUP MODAL HERE-->
    
        <div id="id01" class="modal">
            <form class="modal-content animate" action="userDATA.php" method="POST">
                <div class="imgcontainer">
                <?php
                    if(isset($_GET['invalid'])){
                        echo "<p class='invalidText'>Invalid login, please try again</p>";
                    }
                ?> 
                <span onclick="closeLoginModal()" class="close" title="Close Modal">&times;</span>
                </div>

                <div class="container">
                    <label for="userName"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="userName" required>
                    <label for="passw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="passw" required>
                    <button type="submit" class="submit" name="logIn">Login</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="closeLoginModal()" class="cancelbtn">Cancel</button>
                    <span class="passw">Forgot <a href="#">password?</a></span>
                </div>
                <input type="hidden" name="pageName" value="index.php">
            </form>
        </div> 
        
        <div id="id02" class="modal">
            <form class="modal-content animate" action="userDATA.php" method="post">
                <div class="imgcontainer">
                <?php
                    
                ?> 
                <span onclick="closeSignUpModal()" class="close" title="Close Modal">&times;</span>
                </div>

                <div class="container">
                <label for="firstName" required>Full Name: </label><input type="text" name="firstName" placeholder="First Name"><input type="text" name="lastName" placeholder="Last Name"><br>
                <label for="email" required>Email: </label><p><input type="email" name="email"></p>
                <label for="userName" required>Username: </label><p><input type="text" name="userName" placeholder="Username"></p>
                <label for="password" required>Password: </label><p><input type="password" name="passw" placeholder="Password"></p>
                <label for="SQ1" required>Security Question 1: </label>
                <select name="SQ1">
                    <option value="1" selected>What was your favorite subject in high school?</option>
                    <option value="2">What is the name of your first pet?</option>
                    <option value="3">What is the name of the town where you were born?</option>
                    <option value="4">What was the first company that you worked for?</option>
                </select>
                <input type="text" name="SQVAL1" required placeholder="Answer"><br>
                <label for="SQ2">Security Question 2: </label>
                <select name="SQ2" required>
                    <option value="1">What was your favorite subject in high school?</option>
                    <option value="2" selected>What is the name of your first pet?</option>
                    <option value="3">What is the name of the town where you were born?</option>
                    <option value="4">What was the first company that you worked for?</option>
                </select>
                <input type="text" name="SQVAL2" required placeholder="Answer"><br>
                <button type="submit" class="submit" name="signUp">Sign up</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="closeSignUpModal()" class="cancelbtn">Cancel</button>
                </div>
                <input type="hidden" name="pageName" value="index.php">
            </form>
        </div>
        <?php
        if(isset($_GET['invalid'])){
            echo "testing ";
            echo '<script type="text/JavaScript">openLoginModal();</script>';
        }
    ?>
</body>
</html>