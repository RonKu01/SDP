  <?php
  
  	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();

 
	$sql = 'DELETE FROM student where StudentTP = "'.$_GET['StudentTP'].'"';
	 
	if (mysqli_query($conn,$sql))
		echo '<script>alert("Delete Successful")</script>';
	else
		echo '<script>alert("Unable to delete data")</script>';
	 
	mysqli_close($conn);
	 
	echo '<script>window.location.href="manage_student.php"</script>';
 
 ?> 