  <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_module'])){
			
		$ModuleID = $_REQUEST['ModuleID'];
		$ModuleName = $_REQUEST['ModuleName'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_module')){
					
			$ModuleID = $_POST['ModuleID'];
			$ModuleName = $_POST['ModuleName'];
		}
					
		if (empty($ModuleID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill ModuleID");';
			echo 'window.location = "add_module.php";</script>';
		}
		
		if (empty($ModuleName)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Module Name");';
			echo 'window.location = "add_module.php";</script>';
		}
				
		if (empty($errMsg)) {
				
			$sql = "Select * from module where ModuleID = '".$ModuleID. "'";
			$result = $conn ->query($sql);
				
			if ($result->num_rows == 0) {
				
				$sql2 = "INSERT INTO `module`(`ModuleID`, `ModuleName`) VALUES 
						('".$ModuleID."','".$ModuleName."')";
				$result2 = $conn ->query($sql2);
				
				if(mysqli_affected_rows($conn)== 0){
					echo '<script type="text/javascript">';
					echo 'alert("Failed to add");';
					echo '</script>';
				} else { 
						echo '<script>alert("Module Add Successfully")</script>';
						echo '<script>window.location = "manage_module.php";</script>';
				}
									
			} else {
				
				$sql3 = "SELECT ModuleID FROM module Order by ModuleID DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
				
				if ($result3->num_rows > 0) {
					while ($row = $result3->fetch_assoc()) {
						echo '<script>alert("The ModuleID have been taken. Please start with the next number ! \n \n Current Last ModuleID Used is '.$row["ModuleID"].' !!")</script>';
						echo '<script>window.location = "add_module.php";</script>';
					}
				}
			}
		}	
	}
	
	mysqli_close($conn);
 ?>