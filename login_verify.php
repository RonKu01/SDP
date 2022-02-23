 <?php
 
	require_once 'db_connection.php';
	
	session_start();
	
	if (isset($_SESSION["student_login"])) {
		header("location: student/student_home.php");
	}
	
	if (isset($_SESSION["lecturer_login"])) {
		header("location: lecturer/lecturer_home.php");
	}
	
	if (isset($_SESSION["management_login"])) {
		header("location: management/management_home.php");
	}
	
	if (isset($_SESSION["admin_login"])) {
		header("location: admin/admin_home.php");
	}
	
	 // Check if the form is submitted
	if (isset($_POST['btn_login'])){
		
		//references https://www.ostraining.com/blog/coding/retrieve-html-form-data-with-php/#:~:text=How%20to%20retrieve%20form%20data,the%20element's%20name%20attribute%20values.
		
		// form data retrieved by using the $_REQUEST variable
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$role = $_REQUEST['role'];
		
		// check if the post method is used to submit the form
		if (filter_has_var( INPUT_POST, 'btn_login')){
			//form data retrieved by using $_POST variable
			$username = $_POST['username'];
			$password = $_POST['password'];
			$role = $_POST['role'];
		}
		
		// check whether username got value or not
		if (empty($username)) {
			echo '<script>alert("Please fill username");';
			echo 'window.location = "login.php";</script>';
		}
		
		//check whether password got value or not
		if (empty($password)) {
			echo '<script>alert("Please fill password");</script>';
			echo 'window.location = "login.php";</script>';
		}
		
		//check whether role got value or not
		if (empty($role)) {
			echo '<script>alert("Please select role");</script>';
			echo 'window.location = "login.php";</script>';
		}
		
		//Seperate the condition by role
		switch($role) {
			case "student":
				$sql = "Select * from student where StudentTP = '".$username."';";
				$result = $conn ->query($sql);
				
				if (!empty($result) && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						
						$_SESSION["StudentTP"] = $row['StudentTP'];
						$_SESSION["StudentName"] = $row['StudentName'];
						$_SESSION["Student_Password"] = $row['Password'];
						$_SESSION["Student_CourseID"] = $row['CourseID'];			
						
						if ($_SESSION["Student_Password"] == $password) {
							$_SESSION["student_login"]= true;
							//echo '<script>alert("Login Successfully, welcome '.$_SESSION["StudentName"].'");</script>';
							echo '<script>window.location = "student/student_home.php";</script>';
							
						} else {
							echo '<script>alert("Wrong Password");'; 
							echo 'window.location = "login.php";</script>';
							
						}
					}
				} else {
					echo '<script>alert("Invalid Username or Wrong role");';
					echo 'window.location = "login.php";</script>';
				}			
				break;
			
			case "lecturer":
				$sql = "Select * from lecturer where LecturerID = '".$username."';";
				$result = $conn ->query($sql);
				
				if (!empty($result) && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$_SESSION["LecturerID"] = $row['LecturerID'];
						$_SESSION["LecturerName"] = $row['LecturerName'];
						$_SESSION["Lecturer_Password"] = $row['Password'];
						
						if ($_SESSION["Lecturer_Password"] == $password) {
							$_SESSION["lecturer_login"]= true;
							//echo '<script>alert("Login Successfully, welcome '.$_SESSION["LecturerName"].'");</script>';
							echo '<script>window.location = "lecturer/lecturer_home.php";</script>';
					
						} else {
							echo '<script>alert("Wrong Password");'; 
							echo 'window.location = "login.php";</script>'; 
						}
					}
				} else {
					echo '<script>alert("Invalid Username or Wrong role");';
					echo 'window.location = "login.php";</script>';
				}			
				break;
			
			case "management":
				$sql = "Select * from management_staff where Staff_ID = '".$username."'";
				$result = $conn ->query($sql);
				
				if (!empty($result) && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$_SESSION['Staff_ID'] = $row['Staff_ID'];
						$_SESSION['Staff_Name'] = $row['Staff_Name'];
						$_SESSION['Staff_Password'] = $row['Password'];
						
						
						if ($_SESSION['Staff_Password'] == $password) {
							$_SESSION["management_login"]= true;
							//echo '<script>alert("Login Successfully, welcome '.$_SESSION['Staff_Name'].'");</script>';
							echo '<script>window.location = "management/management_home.php";</script>';
					
						} else {
							echo '<script>alert("Wrong Password");</script>'; 
							echo '<script>window.location = "login.php";</script>'; 
						}
					}
				} else {
					echo '<script>alert("Invalid Username or Wrong role");';
					echo 'window.location = "login.php";</script>';
				}			
				break;
			
			case "admin":
				$sql = "Select * from admin where Admin_Name = '".$username."';";
				$result = $conn ->query($sql);
				
				if (!empty($result) && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						
						$_SESSION['Admin_Name'] = $row['Admin_Name'];
						$_SESSION['Admin_Password'] = $row['Password'];
						
						if ($_SESSION['Admin_Password'] == $password) {
							$_SESSION["admin_login"]= true;
							//echo '<script>alert("Login Successfully, welcome '.$_SESSION['Admin_Name'].'");</script>';
							echo '<script>window.location = "admin/admin_home.php";</script>';
					
						} else {
							echo '<script>alert("Wrong Password");'; 
							echo 'window.location = "login.php";</script>';
						}
					}
				} else {
					echo '<script>alert("Invalid Username or Wrong role");';
					echo 'window.location = "login.php";</script>';
				}
				break;
		}
		mysqli_free_result($result);
		mysqli_close($conn);
	}
 ?>