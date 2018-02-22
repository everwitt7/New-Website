<?php
require 'database.php';
session_start();

$username = $_SESSION['username'];
$storyPost = $_SESSION['id'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("SELECT story_user FROM stories WHERE story_id = '$storyPost'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->bind_result($storyWriter);
$stmt->fetch();
$stmt->close();

if($username != $storyWriter) {
    header("Location: deletefailure.php");
} else {
    $stmt = $mysqli->prepare("DELETE FROM links WHERE links_story_id = '$storyPost'");
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("DELETE FROM comments WHERE comment_story_id = '$storyPost'");
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("DELETE FROM stories WHERE story_id = '$storyPost'");
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    $stmt->execute();
    $stmt->close();

    header("Location: deletesuccess.php");
}



?>
