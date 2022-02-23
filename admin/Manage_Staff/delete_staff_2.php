  <?php
  
  	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();

 
	$sql = 'DELETE FROM management_staff where Staff_ID = "'.$_GET['Staff_ID'].'"';
	 
	if (mysqli_query($conn,$sql))
		echo '<script>alert("Delete Successful")</script>';
	else
		echo '<script>alert("Unable to delete data")</script>';
	 
	mysqli_close($conn);
	 
	echo '<script>window.location.href="manage_staff.php"</script>';
 
 ?> 