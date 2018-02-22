<?php
require 'database.php';
session_start();

$username = $_SESSION['username'];
$storyPost = $_SESSION['id'];
$comment_id = $_POST['comId'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("SELECT comment_user FROM comments WHERE comment_id ='$comment_id'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->bind_result($commentWriter);
$stmt->fetch();
$stmt->close();

if($username != $commentWriter) {
    header("Location: commentfailure.php");
} else {
    $stmt = $mysqli->prepare("DELETE FROM comments WHERE comment_id = '$comment_id'");
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    $stmt->execute();
    $stmt->close();
    header("Location: commentsuccess.php");
}
?>
