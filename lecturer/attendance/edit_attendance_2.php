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

 $AttendanceID = $_SESSION['AttendanceID'] ;

//Step 3
$sql = 'UPDATE attendance SET ClassID = "'.$_POST['ClassID'].'" ,Date = "'.$_POST['Date'].'" ,
Start_Time = "'.$_POST['Start_Time'].'" , End_Time = "'.$_POST['End_Time'].'" ,
OTP_Number = "'.$_POST['OTP_Number'].'" ,Status = "'.$_POST['Status'].'" 
WHERE AttendanceID = "'.$AttendanceID.'"';

if(mysqli_query($conn, $sql))
	echo '<script>alert("Successfully UPDATED")</script>';
else
	echo '<script>alert("Unable to update data")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="attendance_home.php";</script>';

?>