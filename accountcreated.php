<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accout Creation Success</title>
</head>
<body>
    <div class="msg">
        <h1>Account Created Successfully!</h1>
        <h1>...Redirecting to Login Page...</h1>
    </div>
    <?php
    header("refresh:2; url=login.html");
    ?>
</body>
</html>
