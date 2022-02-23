<?php
//Step 1
//Step 2
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../../login.php");
	}

	$LecturerID = $_SESSION["LecturerID"];
	
//Step 3
$sql = "INSERT INTO `feedback`(`LecturerID`, `Bug`, `Details`, `admin_reply`) VALUES ('".$LecturerID."', '".$_POST['Bug']."', '".$_POST['Details']."', 'Pending')"; 

if(mysqli_query($conn, $sql))
	echo '<script>alert("Feedback Submitted")</script>';
else
	echo '<script>alert("Failed to submit")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="feedback_history.php";</script>';

?>

