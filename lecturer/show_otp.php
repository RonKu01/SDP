    <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
		
	} else {
		header("location: ../../login.php");
	}
	
	$OTP_Number = $_SESSION['OTP_Number'] ;

	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>OTP Number</title>
		<link rel = "stylesheet" href ="lecturer.css">
	</head>
	
	<body>
		<div class ="box">
				<h2>One Time Pin</h2>
				<p style ="font-size: 20px">Please insert the number below to take attendance.</p>
				<br><br>
				<input type='text' style= "font-size: 40px; font-family: sans-serif;" name="otp_number" value="<?php echo $OTP_Number?>" readonly>
		
		<br><br>
		
		<a href='end_attendance.php'><button class = "OTPbtn">Finish</button></a>
	</body>

</html>
