<?php
    include 'db_connection.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask A Question</title>
    <link rel="stylesheet" href="navStyle.css">
</head>
<body>
    <main>
        <nav>
           <p id="title">stack<b>underflow</b></p>
        </nav>


        <?php
            if(!isset($_SESSION['USER'])){
                echo "Not logged in";
            }
        ?>
    </main>
    

</body>
</html>