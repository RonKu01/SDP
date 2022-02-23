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
	
	$CourseID = $_SESSION["CourseID"];

//Step 3
$sql = 'UPDATE course SET CourseID = "'.$_POST['CourseID'].'", CourseName = "'.$_POST['CourseName'].'" WHERE CourseID = "'.$CourseID.'"';

if(mysqli_query($conn, $sql))
	echo '<script>alert("Successfully UPDATED")</script>';
else
	echo '<script>alert("Unable to update data")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="manage_course.php";</script>';
?>