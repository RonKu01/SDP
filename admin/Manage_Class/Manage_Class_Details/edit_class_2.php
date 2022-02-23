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


	$sql = "Select * from class where CourseID = '".$_POST['CourseID']. "' AND ModuleID= '".$_POST['ModuleID']."' AND LecturerID= '".$_POST['LecturerID']."'";
	$result = $conn ->query($sql);
						
	if (!empty($result) && $result->num_rows == 0) {
		
		$sql = 'UPDATE class SET CourseID = "'.$_POST['CourseID'].'" ,ModuleID = "'.$_POST['ModuleID'].'" , LecturerID = "'.$_POST['LecturerID'].'"  WHERE ClassID = "'.$_POST['ClassID'].'"';
		$result = $conn ->query($sql);
		
		if(mysqli_affected_rows($conn)== 0){
			echo '<script type="text/javascript">';
			echo 'alert("Failed to add");';
			echo '</script>';
		} else { 
				echo '<script>alert("Update Successfully")</script>';
		}
							
	} else {
		while($row = $result->fetch_assoc()) {
			echo '<script>alert("The Course, Module and Lecturer is same with '.$row["ClassID"].' !!")</script>';
			echo '<script>window.location = "class.php";</script>';
		}

	}
									
//Step 5
mysqli_close($conn);

echo '<script>window.location.href="class.php";</script>';
?>