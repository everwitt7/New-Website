<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comment Delete Success</title>
</head>
<body>
    <div class="msg">
        <h1>Comment Deleted Successfully</h1>
        <h1>...Redirecting to Story Page...</h1>
    </div>
    <?php

    session_start();
    $id = $_SESSION['id'];


    header("refresh:2; url=story.php?id=$id");

    ?>
</body>
</html>
