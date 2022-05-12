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
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <title>Search</title>
</head>
<body>
    <main>
    <?php include "Extra/nav.php"; ?>

    <?php
        include_once "manager.php";
        if(isset($_GET['searchVal'])){
            $searchVal = $_GET['searchVal'];
            $query = getQuestionsByTitle($searchVal);
            if($query != null){

                echo "<h2 id='topQuestionsTitle'>Search results for '$searchVal'</h2>";
                echo "<div class='searchGrid'>";
                while($row = mysqli_fetch_assoc($query)){
                    $title = $row['subject'];
                    $body = $row['body_content'];
                    $views = $row['view_count'];
                    $amountOfAnswers = amountOfAnswers($row['ID']);
                    $date = $row['date_added'];
                    $askedBy = getUserByID($row['asked_by']);
                    $questionID = $row['ID'];
                    echo "
                    <div class='questionsChild'>
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
                echo "</div>";
            }else{
                echo "<h2 id='topQuestionsTitle'>No results found for '$searchVal'</h2>";
            }
        }else{
            header('location: index.php');
        }
    ?>

    <?php include "Extra/footer.php"; ?>

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