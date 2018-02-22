<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>dialog.</title>
</head>
<body>
	<?php
	require 'database.php';

	session_start();

	$_POST['token'] = $_SESSION['token'];
	if(!hash_equals($_SESSION['token'], $_POST['token'])){
		die("Request forgery detected");
	}


	$post_id = $_GET['id'];
	$_SESSION['id'] = $post_id;
	$toke = $_SESSION['token'];
	//$token = $_SESSION['token'];
	$stmt = $mysqli->prepare("SELECT story_user, story_title, story_text, link_url FROM stories WHERE story_id='$post_id'");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->execute();

	$stmt->bind_result($user, $title, $text, $link);


	$stmt->fetch();
	$stmt->close();

	echo "<h1>$title</h1>";
	echo "\n";
	echo "<p>$text</p>";
	if ($link != null) {
		echo "\n";
		echo "<a href=$link>Content Link</a>";
	}
	?>

	<form action="editstory.php" method="POST">
		<input type="submit" value="Edit Story" />
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	</form>

	<br>

	<form action="deletestory.php" method="POST">
		<input type="submit" value="Delete Story" />
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	</form>

	<br>

	<form action="backtostories.php" method="POST">
		<input type="submit" value="Back To Stories" />
	</form>

	<br>

	<form method="POST" action="comment.php">
		<input type="text" name="comment"  required/>
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
		<input type='hidden' name='id' value='<?php echo $post_id;?>' />
		<input type="submit" value="Submit Comment" />
	</form>


	<?php
	$stmt = $mysqli->prepare("select comment_text, comment_user, comment_id from comments where comment_story_id = '$post_id' order by comment_id desc");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->execute();

	$stmt->bind_result($comment_text, $comment_user, $comment_id);
	//$stmt->bind_result($linkurl);


	//trying to delete the comment

	//compare username to comment_user at comment_id


	// echo "<ul style='list-style: none;'>\n";
	while($stmt->fetch()){
		$form = "<form action=deletecomment.php method='POST'><input type='submit' value='Delete Comment'/><input type='hidden' name='token' value='$toke'/>
<input type='hidden' name='comId' value='$comment_id'/></form>";
		$form2 = "<form action=editcomment.php method='POST'><input type='submit' value='Edit Comment'/><input type='hidden' name='token' value='$toke'/>
<input type='hidden' name='com' value='$comment_id'/></form>";

		printf("\t<div style='border: 2px solid green;'> <strong>%s: </strong> <p style='display: inline;'>%s</p> </div>\n",htmlspecialchars($comment_user),
		htmlspecialchars($comment_text)

	);
	echo "$form";
	echo "$form2";
	echo "<br />";
}
// echo "</ul>\n";

$stmt->close();
?>
</body>
</html>
