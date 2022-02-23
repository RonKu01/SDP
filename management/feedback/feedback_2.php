<?php
//Step 1
//Step 2
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$Staff_ID = $_SESSION["Staff_ID"];
	
//Step 3
$sql = "INSERT INTO `feedback`(`Staff_ID`, `Bug`, `Details`, `admin_reply`) VALUES ('".$Staff_ID."', '".$_POST['Bug']."', '".$_POST['Details']."', 'Pending')"; 

if(mysqli_query($conn, $sql))
	echo '<script>alert("Feedback Submitted")</script>';
else
	echo '<script>alert("Failed to submit")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="feedback.php";</script>';

?>