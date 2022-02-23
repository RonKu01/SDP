 <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_admin'])){
			
		$Admin_ID = $_REQUEST['Admin_ID'];
		$Admin_Name = $_REQUEST['Admin_Name'];
		$Password = $_REQUEST['Password'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_admin')){
					
			$Admin_ID = $_POST['Admin_ID'];
			$Admin_Name = $_POST['Admin_Name'];
			$Password = $_POST['Password'];
		}
					
		if (empty($Admin_ID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Admin_ID");';
			echo 'window.location = "add_admin.php";</script>';
		}
		
		if (empty($Admin_Name)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Admin_Name");';
			echo 'window.location = "add_admin.php";</script>';
		}
	
		if (empty($Password)) {
			$errMsg = 1;
			echo '<script>alert("Please enter Password");';
			echo 'window.location = "add_admin.php";</script>';
		}
				
		if (empty($errMsg)) {
				
			$sql = "Select * from admin where Admin_ID = '".$Admin_ID. "'";
			$result = $conn ->query($sql);
				
			if (!empty($result) && $result->num_rows == 0) {
				
				$sql2 = "INSERT INTO `admin`(`Admin_ID`, `Admin_Name`, `Password`) VALUES 
						('".$Admin_ID."','".$Admin_Name."','".$Password."')";
				$result2 = $conn ->query($sql2);
				
				if(mysqli_affected_rows($conn)== 0){
					echo '<script type="text/javascript">';
					echo 'alert("Failed to add");';
					echo '</script>';
				} else { 
						echo '<script>alert("Admin Add Successfully")</script>';
						echo '<script>window.location = "manage_profile.php";</script>';
				}
									
			} else {
				
				$sql3 = "SELECT Admin_ID FROM admin Order by Admin_ID DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
				
				if (!empty($result) && $result3->num_rows > 0) {
					while ($row = $result3->fetch_assoc()) {
						echo '<script>alert("The Admin_ID have been taken. Please start with the next number ! \n \n Current Last Admin_ID Used is '.$row["Admin_ID"].' !!")</script>';
						echo '<script>window.location = "add_admin.php";</script>';
					}
				}
			}
		}	
	}
	
	mysqli_close($conn);
 ?>