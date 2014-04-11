<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['listBox'], $_POST['listBox2'])) {

    $table_name = $_POST['listBox'];
    $new_status = $_POST['listBox2'];

/* 	// Update game status
	$stmt = $mysqli->prepare("UPDATE etsim_games SET status=? WHERE table_name=?");
	if ($stmt) {
	  $stmt->bind_param('sss', $table_name, $new_status, $table_name);
	  $stmt->execute();
	  // Bind results, fetch, etc...
	}
	if (!$stmt) {
		die('There was an error running the query [' . $mysqli->error . ']');
	}
	else
	{
		header('Location: ../admin.php');
	} */
	
	// Update game status 
	$req = "UPDATE etsim_games SET status='". $new_status ."' WHERE table_name='". $table_name ."'";
	$result = $mysqli->query($req);
	if (!$result) {
		die('There was an error running the query [' . $mysqli->error . ']');
	}
	else
	{
		header('Location: ../admin.php');
	}
}
