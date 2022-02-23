 <?php
 
	session_start();
	
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
 
 ?>
 
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Manage Admin Account</title>
		<link href = "../admin.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	</head>
	
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			<ul>
				<li><a href ="../admin_home.php">Homepage</a></li>
				<li><a href='#'>Manage admin Profile</a> </li>
				<li><a href='../Manage_Student/manage_student.php'>Manage student details</a> </li>
				<li><a href='../Manage_Lecturer/manage_lecturer.php'>Manage lecturer details</a> </li>
				<li><a href='../Manage_Staff/manage_staff.php'>Manage staff details</a> </li>
				<li>
					<a href="#" class="nav-extend-btn">Manage Classes
					<span class="fas fa-caret-down first"></span>
				</a>
				<ul class="nav-extend-show">
					<li><a href='../Manage_Class/Manage_Class_Details/class.php'>Class</a></li>
					<li><a href='../Manage_Class/Manage_Course/manage_course.php'>Course</a></li>
					<li><a href='../Manage_Class/Manage_Module/manage_module.php'>Module</a> </li>
				</ul>
				</li>
				<li><a href='../Manage_Feedback/view_feedback.php'>Manage Feedbacks</a> </li>
				<li><a href="../../logout.php">Logout</a></li>
			</ul>
		</nav>
		
		<script>
			$('.btn').click(function(){
				$(this).toggleClass("click");
				$('.sidebar').toggleClass("show");
			});
			
				$('.nav-extend-btn').click(function(){
					$('nav ul .nav-extend-show').toggleClass("show");
					$('nav ul .first').toggleClass("rotate");
				});
				$('nav ul li').click(function(){
					$(this).addClass("active").siblings().removeClass("active");
				});
				
		</script>
		
		
		<div class="box">
		
			<h2>Admin Account Details</h2>
			<input type="text" id="SearchBoxName" onkeyup="SearchName()" placeholder="Search by Name." title="Type in a name">	
			
			<div class='scroll-table'>
				<table border = 1 style = 'text-align: center; font-size:30px;' id="Admin_List">
					<tr bgcolor = 'f8fca2'>
						<th width="100px">ID</th>
						<th width="300px">Admin Name</th>
						<th width="300px">Password</th>
						<th width="150px">Edit</th>
						<th width="150px">Delete</th>
					</tr>
					
					<?php
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .="/sdp/db_connection.php";
					include_once($path);
					
					$sql = "Select * from admin ORDER BY Admin_ID asc";
					$result = $conn ->query($sql);
					
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>'.$row['Admin_ID'].'</td>';
							echo '<td>'.$row['Admin_Name'].'</td>';
							echo '<td>'.$row['Password'].'</td>';
							echo '<td style="width: 50px;"><a href = "edit_admin.php?Admin_ID='.$row['Admin_ID'].'"><button class ="editbutton"> √ </button></a></td>';
							echo '<td style="width: 50px;"><a href = "delete_admin.php?Admin_ID='.$row['Admin_ID'].'"><button class ="deletebutton"> X </button></a></td>';
							echo '</tr>';
						}
					}
					
					mysqli_free_result($result);
					mysqli_close($conn);
					?>
				</table>
			</div>
			<input type="button" class='addbutton' style=' font-size: 20px' value="Add Admin" onclick="window.location='add_admin.php';">
		</div>
			
		<script>
				function SearchName() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById("SearchBoxName");
				  filter = input.value.toUpperCase();
				  table = document.getElementById("Admin_List");
				  tr = table.getElementsByTagName("tr");
				  for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[1];
					if (td) {
					  txtValue = td.textContent || td.innerText;
					  if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}       
				  }
				}
			</script>
		</div>
	</body>
</html>