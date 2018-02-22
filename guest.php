<?php
session_start();

$_SESSION['username'] = 'guest';
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
header('Location: homepage.php')


?>
