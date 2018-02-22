<?php

session_start();
$id = $_SESSION['id'];

header("Location: story.php?id=$id");

?>
