<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Failure</title>
</head>
<body>
    <div class="msg">
        <h1>There is no Account that matches</h1>
        <h1>your Username and/or Password</h1>
        <h1>...Redirecting to Login Page...</h1>
    </div>
    <?php
    header("refresh:2; url=login.html");
    ?>
</body>
</html>
