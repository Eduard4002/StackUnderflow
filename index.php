<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navStyle.css">
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".default_option").click(function(){
			  $(".dropdown ul").addClass("active");
			});

			$(".dropdown ul li").click(function(){
			  var text = $(this).text();
			  $(".default_option").text(text);
			  $(".dropdown ul").removeClass("active");
			});
		});
	</script>
    <script src="JS/loginSignUpButton.js"></script>
    <title>Home</title>
</head>
<body>
    
    <main>
        <?php include "Extra/nav.php"; ?>
        
        <h2 id="topQuestionsTitle">Top Questions</h2>

        <a href="askQuestion.php"><button class="askButton">Ask A question</button></a>

        <!--Main question div-->
        <div class="questionsGrid">
                <?php
                    include "manager.php";
                    $query = getQuestions();
                    if($query != null){
                        while($row = mysqli_fetch_assoc($query)){
                            $title = $row['subject'];
                            $body = $row['body_content'];
                            $views = $row['view_count'];
                            $amountOfAnswers = amountOfAnswers($row['ID']);
                            $date = $row['date_added'];
                            $askedBy = getUserByID($row['asked_by']);
                            $questionID = $row['ID'];
                            echo
                            "<div class='questionsChild'>
                                <div class='left-content'>
                                    <p><b>$views</b> Views</p>
                                    <p><b>$amountOfAnswers</b> Answers</p>
                                </div>
                                <div class='right-content'>
                                    <a class='main-link' href='question.php?ID=$questionID'>$title.</a>
                                    <p class='asked-by'>Asked by <b>$askedBy</b> on <b>$date</b></p>
                                </div>
                            </div>";
                        }
                    }
                    
                ?>
        </div>
        <?php include "Extra/footer.php"; ?>

    </main>       
        <?php 
        include "Extra/modal.php";
            if(isset($_GET['invalid'])){
                echo '<script type="text/JavaScript">openLoginModal();</script>';
        }
        ?>
</body>
</html>