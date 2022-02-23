     <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
		
	} else {
		header("location: ../../login.php");
	}
	
	$ClassID = $_SESSION['ClassID'] ;
	$Date = $_SESSION['Date'];
	$Start_Time = $_SESSION['Start_Time'] ;
	$End_Time = $_SESSION['End_Time'] ;
	$OTP_Number = $_SESSION['OTP_Number'] ;

	
	$sql = 'UPDATE attendance SET Status = "Ended" WHERE ClassID = "'.$ClassID.'" AND Date = "'.$Date.'" AND Start_Time = "'.$Start_Time.'" 
	AND End_Time = "'.$End_Time.'" AND OTP_Number = "'.$OTP_Number.'"' ;
	
	
		if(mysqli_query($conn, $sql)) {
			echo '<script>window.location = "attendance/attendance_home.php";</script>';
		} else {
			echo '<script>alert("Failed to End the Attendance. Please try again.")</script>';
			echo '<script>window.location = "attendance/attendance_home.php";</script>';
		}
		
		
		mysqli_close($conn);
	?>