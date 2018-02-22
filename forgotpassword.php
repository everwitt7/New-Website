<?php
require 'database.php';

$mail = (string) $_POST['email'];

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
    $subject = "Password Recovery";
    $text = "Your Password Is: ";

    //https://stackoverflow.com/questions/4356289/php-random-string-generator
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $tempPass = generateRandomString();
    $saltedPass = password_hash($tempPass, PASSWORD_DEFAULT);
    $text .= $tempPass;

    $stmt = $mysqli->prepare("UPDATE users SET hash = ? WHERE email = ?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('ss', $saltedPass, $mail);
    $stmt->execute();
    $stmt->close();

    mail($mail, $subject, $text);

    header("Location: recoversuccess.php");

} else {
    header("Location: noemail.php");
}


?>
