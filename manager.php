<?php
    include "db_connection.php";
    function getUserID($username){
        $query = mysqli_query(openConn(), "SELECT * FROM users WHERE userName = '$username'");
        return mysqli_fetch_assoc($query)['ID'] ??= '0';
    }
    function successfullLogin($username, $password){
        
        $hashPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query(openConn(), "SELECT * FROM users WHERE userName = '$username' AND passw = '$hashPassw'");
        if($query == null){
            return false;
        }else{
            return true;
        }
    }
    function getUserByID($ID){
        
        $query = mysqli_query(openConn(), "SELECT * FROM users WHERE ID = '$ID'");
        return mysqli_fetch_assoc($query)['userName'] ??= null;
    }
    function addNewUser($fName, $lName, $email, $username, $password, $sqID1, $sqVAL1, $sqID2, $sqVAL2){
        
        $haspPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query(openConn(), "INSERT INTO users VALUES(null, '$fName', '$lName', '$email', '$username', '$haspPassw', '$sqID1', '$sqVAL1', '$sqID2', '$sqVAL2')");
    }
    function addQuestion($title, $body, $userID){
        $date = date("Y/m/d");
        $query = mysqli_query(openConn(), "INSERT INTO question VALUES(null, '$title', '$body', '$date', '0', '$userID')");
    }
    function getQuestions(){
        $query = mysqli_query(openConn(), "SELECT * FROM question ORDER BY view_count DESC LIMIT 10");
        return $query;
    }
    function getQuestionByID($ID){
        $query = mysqli_query(openConn(), "SELECT * FROM question WHERE ID = '$ID'");
        return $query;
    }
    function increaseViewCount($questionID){
        $row = mysqli_fetch_assoc(getQuestionByID($questionID));
        $newCount = $row['view_count'] += 1;
        $query = mysqli_query(openConn(), "UPDATE question SET view_count = '$newCount' WHERE ID = '$questionID'");
        
    }
    
?>