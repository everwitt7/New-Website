<?php

session_start();
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
session_destroy();
header("Location: login.html");

?>
