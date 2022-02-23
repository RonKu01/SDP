  <?php
  
  	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	Session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../../login.php");
	}
 
	$sql = 'DELETE FROM attendance where AttendanceID = "'.$_GET['AttendanceID'].'"';
	 
	if (mysqli_query($conn,$sql))
		echo '<script>alert("DELETE Successful")</script>';
	else
		echo '<script>alert("Unable to delete data")</script>';
	 
	mysqli_close($conn);
	 
	echo '<script>window.location.href="attendance_home.php"</script>';
 
 ?>