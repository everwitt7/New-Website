<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guest Failure</title>
</head>
<body>
    <div class="msg">
        <h1>You Are A Guest And Do Not Have</h1>
        <h1>Permission To Perform This Action</h1>
        <h1>...Redirecting...</h1>
    </div>
    <?php

    header("refresh:2; url=homepage.php");

    ?>
</body>
</html>
