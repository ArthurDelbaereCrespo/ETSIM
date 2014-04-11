<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['gamename'], $_POST['location'], $_POST['comments'])) {

    $game_name = $mysqli->real_escape_string($_POST['gamename']);
	$game_name = preg_replace('/\s+/', '', $game_name);
    $location = $mysqli->real_escape_string($_POST['location']);
    $comments = $mysqli->real_escape_string($_POST['comments']);

	$time = date("Y-m-d H:i:s");
	$time2 = date("YmdHi");
	$table_name = "etsim_" . $game_name . "_" . $time2;
	
	// Insert the new game into the database 
	if ($insert_stmt = $mysqli->prepare("INSERT INTO etsim_games (creationtime, name, table_name, location, comments) VALUES (?, ?, ?, ?, ?)")) 
	{
		$insert_stmt->bind_param('sssss', $time, $game_name, $table_name, $location, $comments);
		// Execute the prepared query.
		if (! $insert_stmt->execute()) {
			die('There was an error running the query [' . $mysqli->error . ']');
		}
	}
	
	// Create a new table in the database 
	$req =
		"CREATE TABLE `".$table_name."` (
		id INT NOT NULL AUTO_INCREMENT,
		game_round INT,
		user VARCHAR(50), 
		bid_volume FLOAT, 
		bid_price FLOAT,
		market_price FLOAT,
		PRIMARY KEY (id))";
	$result = $mysqli->query($req);
	if (!$result) {
		die('There was an error running the query [' . $mysqli->error . ']');
	}
	else
	{
		header('Location: ../admin.php');
	}
}
