<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Story</title>
</head>
<body>
    <?php
    require 'database.php';
    session_start();

    $username = $_SESSION['username'];
    $storyPost = $_SESSION['id'];

    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }

    $stmt = $mysqli->prepare("SELECT story_user FROM stories WHERE story_id = '$storyPost'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($storyWriter);
    $stmt->fetch();
    $stmt->close();

    if($username != $storyWriter) {
        header("Location: editfailure.php");
    } else {
        $stmt = $mysqli->prepare("SELECT story_text, story_title FROM stories WHERE story_id ='$storyPost'");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->execute();
        $stmt->bind_result($text, $title);
        $stmt->fetch();
        $stmt->close();
        $editText = substr($text, 1, -1);


    }

    ?>

    <form method="GET" action="updatestory.php">

        <h1>Edit Your Story Here:</h1>

        <div>

            <label for="usertitle">Please Edit the Title for your Story</label>
            <br>
            <input type="text" name="usertitle" id="usertitle" value="<?php echo htmlspecialchars($title); ?>" required>

            <br>

            <p>Please Edit Your Story</p>
            <textarea required id="userstory" name="userstory" rows="20" cols="60"><?php echo htmlspecialchars($editText); ?></textarea>

            <br>

        </div>

        <div>
            <button type="submit">Edit Story</button>
        </div>
    </form>
    <form class="" action="originalstory.php" method="post">
        <button type="submit">Back To Your Story</button>
    </form>
</body>
</html>
