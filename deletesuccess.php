<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete Success</title>
</head>
<body>
    <div class="msg">
        <h1>Story Deleted Successfully!</h1>
        <h1>...Redirecting to Story Page...</h1>
    </div>
    <?php
    header("refresh:2; url=homepage.php");
    ?>
</body>
</html>
