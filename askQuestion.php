<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask A Question</title>
    <link rel="stylesheet" href="CSS/navStyle.css">
    <link rel="stylesheet" href="CSS/askQuestion.css">
    <script src="JS/loginSignUpButton.js"></script>
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
        

    </main>
    

</body>
</html>