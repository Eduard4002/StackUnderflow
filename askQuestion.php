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
        <?php include "Extra/nav.php";?>
        <h2 id="askQuestionTitle">Ask a question</h2>
        <div class="main-content">
            <form action="userDATA.php" method="POST" >
                <div class="formContainer container">
                    <label for="title"><b>Title</b></label>
                    <p>Be specific and imagine you’re asking a question to another person</p>
                    <input type="text" placeholder="Title" name="title" required>
                    <label for="body"><b>Body</b></label>
                    <p>Include all the information someone would need to answer your question</p>
                    <textarea name="body" required placeholder="Text"></textarea>
                    <input type="hidden" name="pageName" value="askQuestion.php">
                    <button type="submit" class="submit" name="postQ">Post Question</button>
                    <button type="button" class="cancelbtn"><a href="index.php" class="formA">Go Back</a></button>
                    <button type="reset" class="cancelbtn">Reset</button>
                </div>

                
                <input type="hidden" name="pageName" value="askQuestion.php">
                
            </form>
        </div> 
        <div class="info container">
            <p><i>The community is here to help you with specific coding, algorithm, or language problems. <br>Avoid asking opinion-based questions.</i></p>
            <p>1. <b>Summarize the problem</b><br>
                Include details about your goal.<br>
                Describe expected and actual results.<br>
                Include any error messages.</p>
            <p><b>2.Describe what you’ve tried</b><br>
                Show what you’ve tried and tell us what you found (on this site or elsewhere) and why it didn’t meet your needs. ¨
                You can get better answers when you provide research.</p>
            <p><b>3.Show some code</b><br>
                When appropriate, share the minimum amount of code others need to reproduce your problem</p>
        </div>
    <?php include "Extra/footer.php";?>
    </main>
    <?php 
        include "Extra/modal.php";
        //for all the errors from the userDATA.php
        if(isset($_GET['invalidLog'])){
            echo '<script type="text/JavaScript">openLoginModal();</script>';
        }else if(isset($_GET['notLoggedIn'])){
            echo '<script type="text/JavaScript">openLoginModal();</script>';
        }else if(isset($_GET['passwNotMatch'])){
            echo '<script type="text/JavaScript">openChangPassw();</script>';
        }else if(isset($_GET['wrongSecQ'])){
            echo '<script type="text/JavaScript">openChangPassw();</script>';
        }else if(isset($_GET['passwChanged'])){
            echo '<script type="text/JavaScript">openChangPassw();</script>';
        }
    ?>
</body>
</html>