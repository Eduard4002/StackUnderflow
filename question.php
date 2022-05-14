<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navStyle.css">
    <link rel="stylesheet" href="CSS/viewQuestion.css">
    <script src="JS/loginSignUpButton.js"></script>
    <title>Question</title>
</head>
<body>
    <main>
            <?php include "Extra/nav.php"; ?>
            <div class="formContainer">
            <?php
                include_once "manager.php";
                if(isset($_GET['ID'])){
                    $ID = $_GET['ID'];
                    //increase the view count
                    $row = getQuestionByID($ID);
                    if($row != null){
                        increaseViewCount($ID);
                        //get all the necessary information
                        $title = $row['subject'];
                        $body = $row['body_content'];
                        $views = $row['view_count'];
                        $date = $row['date_added'];
                        $askedBy = getUserByID($row['asked_by']);
                        //for testing purposes
                        echo "
                        <h1>$title</h1>
                        <div class='up-content'>
                            <p>Asked <b>$date</b> Viewed <b>$views</b> times.</p>
                            <p>Asked by <b>$askedBy</b></p>
                        </div>
                        <div class='down-content'>
                            <textarea readonly>$body</textarea>
                        </div>";
                        
                        
                    }else{
                        echo "<h2 class='invalidID'>Ops, how did you even manage to get here? We weren't able to find this question you were looking!<br> Please try again later</h2>
                        <button><a href = 'index.php' class='formA'>Go Back</a></button>";
                    }
                    
                }
            ?>

            </div>
            <h2 class="replyTitle"><b>Replies</b></h2>
            <?php
                    $query = getRepliesByQuestionID($_GET['ID']);
                    if($query != null){
                        while($row = mysqli_fetch_assoc($query)){
                            $ID = $_GET['ID'];
                            $body = $row['content'];
                            $date = $row['date_added'];
                            $reply_author = getUserByID($row['reply_by']);
                            $question = getQuestionByID($ID);
                            $asked_by = getUserByID($question['asked_by']);
                            $reply_id = $row['ID'];
                            $isAnswer = $row['isAnswer'];
                            $currentUserSession = $_SESSION['USER'] ??= null;
                            echo
                            "<div class='formContainer replyContainer'>
                                <div class='up-content'>
                                    <p><b>$date</b></p>
                                    <p>Replied By <b>$reply_author</b></p>";
                                    //if the user is logged in and the reply is not an answer then show the delete button
                                    if(getUserByID($_SESSION['USER']) == $reply_author && $isAnswer == 0){
                                        echo "
                                        <form action='userDATA.php?repID=$reply_id' method='POST'>
                                            <input type='hidden' name='pageName' value='question.php'>
                                            <input type='hidden' name='questionID' value="; echo "$ID";echo ">
                                            <button type='submit' name='delRep' class='deleteReply'>DELETE</button>
                                        </form>";
                                    }
                                    echo "
                                </div>
                                <div class='down-content'>";
                                    //if it's an answer then show it as such
                                    if($isAnswer == 1){
                                        echo "<p class='answer'><B>MARKED AS ANSWER</B></p>";
                                    }
                                    echo "<textarea readonly>$body</textarea>";
                                    //if the user is logged in and the reply is not an answer then show the mark as answer button
                                    if($isAnswer == 0 && getUserByID($_SESSION['USER']) == $asked_by){
                                        $ID = $_GET['ID'];
                                        echo "
                                        <form action='userDATA.php?ansID=$reply_id' method='POST'>
                                            <input type='hidden' name='pageName' value='question.php'>
                                            <input type='hidden' name='questionID' value="; echo "$ID";echo ">
                                            <button type='submit' name='markA'>Mark As Answer</button>
                                        </form>";
                                    }
                                    
                                   echo "
                                </div>
                            </div>";
                            
                        }
                    }
                    
            ?>
            <div class="formContainer">
                <h2><b>Your Answer</b></h2>
                <div class="down-content    ">
                    <form action="userDATA.php?postA" method="POST">
                        <textarea name="body" required placeholder="Text"></textarea>
                        <input type="hidden" name="pageName" value="question.php">
                        <input type="hidden" name="questionID" value="<?php echo $ID; ?>">
                        <button type="submit" name="postA">Post Your Answer</button>

                    </form>
                </div>
                
            </div>
        <?php
            include "Extra/footer.php";
        ?>
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