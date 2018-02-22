<?php
require 'database.php';

$username = (string) $_POST['username'];
$password = (string) $_POST['password'];
$email = (string) $_POST['email'];

$saltedPass = password_hash($password, PASSWORD_DEFAULT);


//https://stackoverflow.com/questions/11292468/how-to-check-if-value-exists-in-a-mysql-database
$stmt = $mysqli->prepare("SELECT username FROM users WHERE username = '$username'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->bind_result($result);
$stmt->fetch();
$stmt->close();

if (strcmp($result, $username) == 0) {
    header("Location: existinguser.php");

} else {

    $stmt = $mysqli->prepare("INSERT INTO users (username, hash, email) VALUES (?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    } else {
        $stmt->bind_param('sss', $username, $saltedPass, $email);

        $stmt->execute();

        $stmt->close();

        header("Location: accountcreated.php");
    }
}

?>
