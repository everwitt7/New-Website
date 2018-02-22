<?php
require 'database.php';
session_start();

$comment = $_POST['comment'];
$id = $_POST['id'];
//$token_p = $_POST['token'];
//$token_s = $_SESSION['token'];
//$story_user = $_POST['story_user'];
// echo "<h1>$token_p</h1>";
// echo "\n";
// echo "<h1>$token_s</h1>";
// echo "\n";

//echo "<h1>$title</h1>";
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}


if ($_SESSION['username'] == 'guest') {
    header('Location: guestrest.php');
} else {
	$username = $_SESSION['username'];
	$link = NULL;

	$stmt = $mysqli->prepare("INSERT INTO comments (comment_story_id, comment_text, comment_id, comment_user) VALUES (?, ?, ?, ?)");
	if(!$stmt){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
	}
	$stmt->bind_param('isis', $id, $comment, $null, $username);
	$stmt->execute();
	$stmt->close();
	header("Location: story.php?id=$id");
}


?>
