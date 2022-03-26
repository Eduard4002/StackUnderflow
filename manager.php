<?php
    include "../db_anslutning1/include/db_conn_inc.php";

    function addTransaction($amount, $userID, $fromUserID){
        global $conn;
        if($fromUserID == null){
            $query = mysqli_query($conn, "INSERT INTO transactions VALUES(null, '$amount', '$userID', null)");
        }else{
            $query = mysqli_query($conn, "INSERT INTO transactions VALUES(null, '$amount', '$userID', '$fromUserID')");
        }
        
    }
    function returnTransactions($userID){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM transactions WHERE userID ='$userID'");
        return $query;
    }
    function getUserID($username){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        return mysqli_fetch_assoc($query)['ID'] ??= '0';
    }
    function successfullLogin($username, $password){
        global $conn;
        $hashPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$hashPassw'");
        if($query == null){
            return false;
        }else{
            return true;
        }
    }
    function getUserByID($ID){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM users WHERE ID = '$ID'");
        return mysqli_fetch_assoc($query)['username'] ??= null;
    }
    function calculateSaldo($userID){
        $transactions = returnTransactions($userID);
        //starting amount
        $amount = 1000;
        while($r = mysqli_fetch_array($transactions))
        {
            $amount += $r['amount'];
        }
        return $amount;
    }
    function addNewUser($username, $password, $firstName, $lastName){
        global $conn;
        $haspPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "INSERT INTO users VALUES(null, '$username', '$haspPassw', '$firstName', '$lastName')");
    }
    function sendTransaction($from, $to, $amount){
        
    }
    
?>