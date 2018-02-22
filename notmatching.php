<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Not Matching</title>
</head>
<body>
    <div class="msg">
        <h1>Your Password Did Not Match</h1>
        <h1>Please Retype Your New Password</h1>
        <h1>...Redirecting to Reset Page...</h1>
    </div>
    <?php

    session_start();
    $id = $_SESSION['id'];


    header("refresh:2; url=reset.html");

    ?>
</body>
</html>
