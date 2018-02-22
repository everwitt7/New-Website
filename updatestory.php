<?php
require 'database.php';
session_start();

$title = (string) $_GET['usertitle'];
$story = '"'.(string) $_GET['userstory'].'"';
$id = $_SESSION['id'];

$stmt = $mysqli->prepare("UPDATE stories SET story_text = ?, story_title = ? WHERE story_id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('sss', $story, $title, $id);
$stmt->execute();
$stmt->close();

header("Location: story.php?id=$id");

?>
