<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete Failure</title>
</head>
<body>
    <div class="msg">
        <h1>You Did Not Write This Story</h1>
        <h1>So You Cannot Delete It</h1>
        <h1>...Redirecting to Story Page...</h1>
    </div>
    <?php

    session_start();
    $id = $_SESSION['id'];


    header("refresh:2; url=story.php?id=$id");

    ?>
</body>
</html>
