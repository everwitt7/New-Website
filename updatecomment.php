<?php
require 'database.php';
session_start();

$story = (string) $_POST['userstory'];
$id = $_SESSION['id'];
$comment_id = $_SESSION['com'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}


$stmt = $mysqli->prepare("UPDATE comments SET comment_text = ? WHERE comment_id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('ss', $story, $comment_id);
$stmt->execute();
$stmt->close();

header("Location: story.php?id=$id");

?>
