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

//Step 3
$sql = 'UPDATE management_staff SET Staff_Name = "'.$_POST['Staff_Name'].'" ,
Password = "'.$_POST['Password'].'" WHERE Staff_ID = "'.$_POST['Staff_ID'].'"';

if(mysqli_query($conn, $sql))
	echo '<script>alert("Successfully UPDATED")</script>';
else
	echo '<script>alert("Unable to update data")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="manage_staff.php";</script>';
?>