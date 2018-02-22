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
    $http = "https://";
    $linkChoice = $_GET['linkchoice'];

    $title = (string) $_GET['usertitle'];
    $story = '"'.(string) $_GET['userstory'].'"';
    $username = $_SESSION['username'];

    if($linkChoice == 'Title Unlinked') {
        $link = null;
    } else {
        $link = (string) $_GET['linkurl'];
        $subLink = substr ($link, 0, 8);
        if($subLink == "https://") {
            $finalLink = $link;
        } else {
            $http .= $link;
            $finalLink = $http;
        }
    }

    $stmt = $mysqli->prepare("INSERT INTO stories (story_text, story_user, story_title, link_url) VALUES (?, ?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('ssss', $story, $username, $title, $finalLink);
    $stmt->execute();
    $stmt->close();

    header("Location: storypublished.php");
}



?>
