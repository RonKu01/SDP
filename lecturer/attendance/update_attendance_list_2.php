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

//Step 3
$sql = 'UPDATE attendance_detail SET Attend_Status = "'.$_POST['Attend_Status'].'" WHERE ID = "'.$_POST['ID'].'" AND AttendanceID = "'.$_POST['AttendanceID'].'" AND StudentTP = "'.$_POST['StudentTP'].'"';

if(mysqli_query($conn, $sql))
	echo '<script>alert("Successfully UPDATED")</script>';
else
	echo '<script>alert("Unable to update data")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="student_list.php?AttendanceID='.$_POST['AttendanceID'].'";</script>';

?>
















