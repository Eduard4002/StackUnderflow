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
        return mysqli_fetch_assoc($query)['username'] ??= null;
    }
    function addNewUser($fName, $lName, $email, $username, $password, $sqID1, $sqVAL1, $sqID2, $sqVAL2){
        
        $haspPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query(openConn(), "INSERT INTO users VALUES(null, '$fName', '$lName', '$email', '$username', '$haspPassw', '$sqID1', '$sqVAL1', '$sqID2', '$sqVAL2')");
    }
    
?>