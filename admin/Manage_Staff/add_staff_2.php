  <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_staff'])){
			
		$Staff_ID = $_REQUEST['Staff_ID'];
		$Staff_Name = $_REQUEST['Staff_Name'];
		$Password = $_REQUEST['Password'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_staff')){
					
			$Staff_ID = $_POST['Staff_ID'];
			$Staff_Name = $_POST['Staff_Name'];
			$Password = $_POST['Password'];
		}
					
		if (empty($Staff_ID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Staff_ID");';
			echo 'window.location = "add_staff.php";</script>';
		}
		
		if (empty($Staff_Name)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Staff Name");';
			echo 'window.location = "add_staff.php";</script>';
		}
		
		if (empty($Password)) {
			$errMsg = 1;
			echo '<script>alert("Please enter Password");';
			echo 'window.location = "add_staff.php";</script>';
		}
				
		if (empty($errMsg)) {
				
			$sql = "Select * from management_staff where Staff_ID = '".$Staff_ID. "'";
			$result = $conn ->query($sql);
				
			if ($result->num_rows == 0) {
				
				$sql2 = "INSERT INTO `management_staff`(`Staff_ID`, `Staff_Name`, `Password`) VALUES 
						('".$Staff_ID."','".$Staff_Name."','".$Password."')";
				$result2 = $conn ->query($sql2);
				
				if(mysqli_affected_rows($conn)== 0){
					echo '<script type="text/javascript">';
					echo 'alert("Failed to add");';
					echo '</script>';
				} else { 
						echo '<script>alert("Staff Add Successfully")</script>';
						echo '<script>window.location = "manage_staff.php";</script>';
				}
									
			} else {
				
				$sql3 = "SELECT Staff_ID FROM management_staff Order by Staff_ID DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
				
				if ($result3->num_rows > 0) {
					while ($row = $result3->fetch_assoc()) {
						echo '<script>alert("The Staff_ID have been taken. Please start with the next number ! \n \n Current Last Staff_ID Used is '.$row["Staff_ID"].' !!")</script>';
						echo '<script>window.location = "add_staff.php";</script>';
					}
				}
			}
		}	
	}
	
	mysqli_close($conn);
 ?>