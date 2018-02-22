<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Comment</title>
</head>
<body>


    <?php
    require 'database.php';
    session_start();

    $username = $_SESSION['username'];
    $storyPost = $_SESSION['id'];
    $comment_id = $_POST['com'];
    $_SESSION['com'] = $comment_id;
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
    }

    $stmt = $mysqli->prepare("SELECT comment_user FROM comments WHERE comment_id ='$comment_id'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($commentWriter);
    $stmt->fetch();
    $stmt->close();

    if($username != $commentWriter) {
        header("Location: editcommentfailure.php");
    } else {
        $stmt = $mysqli->prepare("SELECT comment_text FROM comments WHERE comment_id='$comment_id'");
        if(!$stmt){
        	printf("Query Prep Failed: %s\n", $mysqli->error);
        	exit;
        }
        $stmt->execute();
        $stmt->bind_result($text);
        $stmt->fetch();
        $stmt->close();
    }
    ?>

    <form method="POST" action="updatecomment.php">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <h1>Edit Your Comment Here:</h1>

        <div>

            <p>Please Edit Your Comment</p>
            <textarea required id="userstory" name="userstory" rows="20" cols="60"><?php echo htmlspecialchars($text);?></textarea>

            <br>

        </div>

        <div>
            <button type="submit">Edit Comment</button>
        </div>
    </form>
    <form class="" action="originalstory.php" method="post">
        <button type="submit">Back To The Story</button>
    </form>


</body>
</html>
