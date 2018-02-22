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

    $stmt = $mysqli->prepare("DELETE FROM links WHERE links_user = '$username'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("DELETE FROM comments WHERE comment_user = '$username'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT story_id FROM stories WHERE story_user = '$username'");
    if(!$stmt){
      printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $num = 0;
    while($posts = $result->fetch_assoc()){
        $postArray[$num] = $posts["story_id"];
        $num++;
    }
    $stmt->close();

    for ($i = 0; $i < $num; $i++) {
        $stmt = $mysqli->prepare("delete from comments where comment_story_id = '$postArray[$i]'");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->execute();
        $stmt->close();
    }

    $stmt = $mysqli->prepare("delete from stories where story_user = '$username'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("delete from users where username = '$username'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->close();

    header("Location: login.html");
}



?>
