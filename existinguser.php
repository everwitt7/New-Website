<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Username Taken</title>
</head>
<body>
    <div class="msg">
        <h1>Someone Already has that Username</h1>
        <h1>Please Select another One</h1>
        <h1>...Redirecting to Account Page...</h1>
    </div>
    <?php
    header("refresh:2; url=createaccount.html");
    ?>
</body>
</html>
