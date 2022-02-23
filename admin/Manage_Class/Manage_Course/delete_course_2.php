  <?php
  
  	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	Session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
 
	$sql = 'DELETE FROM course where CourseID = "'.$_GET['CourseID'].'"';
	 
	if (mysqli_query($conn,$sql))
		echo '<script>alert("Delete Successful")</script>';
	else
		echo '<script>alert("Unable to delete data")</script>';
	 
	mysqli_close($conn);
	 
	echo '<script>window.location.href="manage_course.php"</script>';
 
 ?>