<?php
require 'database.php';

session_start();

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), username, hash FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user);
$user = $_POST['user'];
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['pass'];

//Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
	$_SESSION['username'] = $user_id;
	// Redirect to your target page
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	header("Location: homepage.php");
} else{
	// Login failed; redirect back to the login screen
	header("Location: loginfailure.php");
}
?>
