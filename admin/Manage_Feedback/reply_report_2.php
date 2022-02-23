<?php
//Step 1
//Step 2
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$ID = $_SESSION['Report_ID'];
	
	//Step 3
	$sql = 'UPDATE feedback SET Admin_Reply = "'.$_POST['Respond'].'" WHERE ID = "'.$ID.'"';

	if(mysqli_query($conn, $sql)) {
		echo '<script>alert("Respond Submmited!")</script>';
	} else {
		echo '<script>alert("Unable to update data")</script>';
	}
	
	//Step 5
	mysqli_close($conn);

	echo '<script>window.location.href="view_feedback.php";</script>';
?>