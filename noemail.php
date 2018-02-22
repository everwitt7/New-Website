<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>No Username/Email Combination</title>
</head>
<body>
    <div class="msg">
        <h1>No Username matches the Email you Provided</h1>
        <h1>...Redirecting to Login Page...</h1>
    </div>
    <?php

    header("refresh:2; url=login.html");

    ?>
</body>
</html>
