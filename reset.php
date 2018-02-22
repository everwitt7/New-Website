<?php

require 'database.php';
session_start();

$_POST['token'] = $_SESSION['token'];
if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}

if ($_SESSION['username'] == 'guest') {
    header('Location: guestrest.php');
} else {
    $username = $_SESSION['username'];

    $new = $_POST['new'];
    $conf = $_POST['conf'];


    if(strcmp($new, $conf) == 0) {

        $saltedPass = password_hash($new, PASSWORD_DEFAULT);


        $stmt = $mysqli->prepare("UPDATE users SET hash = ? WHERE username = ?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('ss', $saltedPass, $username);
        $stmt->execute();
        $stmt->close();

        header("Location: homepage.php");

    } else {
        header("Location: notmatching.php");
    }
}



?>
