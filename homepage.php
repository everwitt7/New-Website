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

	$username = $_SESSION['username'];
	echo "<h1>Welcome ".$username."!</h1>";
	?>
	<div>
		<p>Recent Stories</p>
	</div>
	<?php

	$stmt = $mysqli->prepare("SELECT story_id, story_title, story_user FROM stories ORDER BY story_id DESC");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->execute();
	$stmt->bind_result($id, $title, $user);


	echo "<ul>\n";
	while($stmt->fetch()){
		printf("\t<li> <a href='%s'> %s</a> Submitted by %s </li>\n",
		"./story.php?id=".htmlspecialchars($id),
		htmlspecialchars($title),
		htmlspecialchars($user));
	}
	echo "</ul>\n";

	$stmt->close();

	?>
	<div>
		<form action="submit.html">
			<input type="submit" name="submit" value="Submit a Story" />
		</form>

		<br>

		<form action="reset.html">
			<input type="submit" name="submit" value="Reset Password" />
		</form>

		<br>

		<form action="deleteaccount.php">
			<input type="submit" name="submit" value="Delete Account" />
		</form>

		<br>

		<form action="logout.php">
			<input type="submit" name="submit" value="Lougout" />
		</form>
	</div>

</body>
</html>
