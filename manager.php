<?php
    include "db_connection.php";
    //gets user's id from the username
    function getUserID($username){
        $query = mysqli_query(openConn(), "SELECT * FROM users WHERE userName = '$username'");
        if(mysqli_num_rows($query) == 1){
            $row = mysqli_fetch_assoc($query);
            return $row['ID'];
        }else{
            return 0;
        }
    }
    //get the username by ID
    function getUserByID($ID){
        $query = mysqli_query(openConn(), "SELECT * FROM users WHERE ID = '$ID'");
        return mysqli_fetch_assoc($query)['userName'] ??= null;
    }
    //checks if the user logged in correctly
    function successfullLogin($username, $password){
        $query = mysqli_fetch_assoc(mysqli_query(openConn(), "SELECT * FROM users WHERE userName = '$username'"));
                
        if(password_verify($password, $query['passw'])){
            return true;
        }else{
            return false;
        }
        
    }
    //adds a new user to the database
    function addNewUser($fName, $lName, $email, $username, $password, $sqID1, $sqVAL1, $sqID2, $sqVAL2){
        $hashPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query(openConn(), "INSERT INTO users VALUES(null, '$fName', '$lName', '$email', '$username', '$hashPassw', '$sqID1', '$sqVAL1', '$sqID2', '$sqVAL2')");
    }
    //checks that security questions match with the user's answers
    function checkSecQuestions($username, $sqID1, $sqVAL1, $sqID2, $sqVAL2){
            $query = mysqli_query(openConn(), "SELECT * FROM users WHERE userName = '$username' AND sqID1 = '$sqID1' AND sqVAL1 = '$sqVAL1' AND sqID2 = '$sqID2' AND sqVAL2 = '$sqVAL2'");
            if(mysqli_num_rows($query) == 0){
                return false;
            }else{
                return true;
            }
    }
    //update the user's password incase they forgot it
    function updatePassword($username, $password){
        $hashPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query(openConn(), "UPDATE users SET passw = '$hashPassw' WHERE userName = '$username'");
    }
    //add question to the database
    function addQuestion($title, $body, $userID){
        $date = date("Y/m/d");
        $query = mysqli_query(openConn(), "INSERT INTO question VALUES(null, '$title', '$body', '$date', '0', '$userID')");
    }
    //get the top 10 questions and order by view_count
    function getQuestions(){
        $query = mysqli_query(openConn(), "SELECT * FROM question ORDER BY view_count DESC LIMIT 10");
        return $query;
    }
    //get the question by ID
    function getQuestionByID($ID){
        $query = mysqli_fetch_assoc(mysqli_query(openConn(), "SELECT * FROM question WHERE ID = '$ID'"));
        return $query;
    }
    //increase view count by 1 for the question
    function increaseViewCount($questionID){
        $row = getQuestionByID($questionID);
        $newCount = $row['view_count'] += 1;
        $query = mysqli_query(openConn(), "UPDATE question SET view_count = '$newCount' WHERE ID = '$questionID'");
    }
    //get the replies for the question and order by isAnswer descending
    function getRepliesByQuestionID($questionID){
        $query = mysqli_query(openConn(), "SELECT * FROM reply WHERE question_id = '$questionID' ORDER BY isAnswer DESC");
        return $query;
    }
    //get the reply by ID
    function getReplyByID($ID){
        $query = mysqli_fetch_assoc(mysqli_query(openConn(), "SELECT * FROM reply WHERE ID = '$ID'"));
        return $query;
    }
    //add a new reply to the database
    function addReply($body, $questionID, $userID){
        $date = date("Y/m/d");
        $query = mysqli_query(openConn(), "INSERT INTO reply VALUES(null, '$body', '$date', '$questionID', '$userID', '0')");
        addInbox("newRep", $userID);
    }
    //mark a reply as answer
    function markAnswer($replyID){
        $query = mysqli_query(openConn(), "UPDATE reply SET isAnswer = '1' WHERE ID = '$replyID'");
        addInbox("markA", $replyID);
    }
    //find the amount of answers per question
    function amountOfAnswers($questionID){
        $query = mysqli_query(openConn(), "SELECT * FROM reply WHERE question_id = '$questionID' AND isAnswer = '1'");
        return mysqli_num_rows($query);
    }
    //delete a reply
    function deleteReply($replyID){
        $query = mysqli_query(openConn(), "DELETE FROM reply WHERE ID = '$replyID'");
    }
    //get all inbox messages for the user
    function getInbox($userID){
        $query = mysqli_query(openConn(), "SELECT * FROM inbox WHERE user_ID = '$userID'");
        return $query;
    }
    //add a new message to the inbox
    function addInbox($action, $value){
        //incase we want to add more values to the same action
        $values = explode("-", $value);
        //Your reply has been marked as the correct answer
        if($action == "markA"){
            $query = mysqli_fetch_assoc(mysqli_query(openConn(), "SELECT * FROM reply WHERE ID = '$values[0]'"));
            $user_ID = $query['reply_by'];
            $query = mysqli_query(openConn(), "INSERT INTO inbox VALUES(null, '$user_ID', '$action', '$values[0]')");
        //someone added a new reply to your question
        //$value == ID of the person that posted the reply
        }else if($action == "newRep"){
            $query = mysqli_fetch_assoc(mysqli_query(openConn(), "SELECT * FROM question WHERE asked_by = '$values[0]'"));
            $user_ID = $query['asked_by'];
            $query = mysqli_query(openConn(), "INSERT INTO inbox VALUES(null, '$user_ID', '$action', '$values[0]')");
        }   
    }
    function getQuestionsByTitle($title){
        $query = mysqli_query(openConn(), "SELECT * FROM question WHERE subject LIKE '%$title%'");
        return $query;
    }
    
?>