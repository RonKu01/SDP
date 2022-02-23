  <?php
  
  	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	Session_start();

 
	$sql = 'DELETE FROM admin where Admin_ID = "'.$_GET['Admin_ID'].'"';
	 
	if (mysqli_query($conn,$sql))
		echo '<script>alert("Delete Successful")</script>';
	else
		echo '<script>alert("Unable to delete data")</script>';
	 
	mysqli_close($conn);
	 
	echo '<script>window.location.href="manage_profile.php"</script>';
 
 ?> 