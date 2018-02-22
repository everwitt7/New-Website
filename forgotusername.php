<?php
require 'database.php';

$mail = (string) $_POST['email'];

$stmt = $mysqli->prepare("SELECT username FROM users WHERE email = '$mail'");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT email FROM users WHERE email = '$mail'");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->execute();
$stmt->bind_result($result);
$stmt->fetch();
$stmt->close();

if (strcmp($result, $mail) == 0) {
    $subject = "Username Recovery";
    $text = "Your Username Is: ";

    $text .= $username;

    mail($mail, $subject, $text);

    header("Location: recoverusersuccess.php");

} else {
    header("Location: noemail.php");
}
?>
