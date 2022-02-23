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
		<title>Manage Lecturer Account</title>
		<link href = "../admin.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
		<style>
		tr {
		height:30px;	
		}
		</style>
	</head>
	
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			<ul>
				<li><a href ="../admin_home.php">Homepage</a></li>
				<li><a href='../Manage_Admin/manage_profile.php'>Manage admin Profile</a> </li>
				<li><a href='../Manage_Student/manage_student.php'>Manage student details</a> </li>
				<li><a href='#'>Manage lecturer details</a> </li>
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
			<h2>Lecturer Account Details</h2>
			
			
				
			<pre>  <input type="text" style='width:auto;' id="SearchBoxID" onkeyup="SearchID()" placeholder="Search by LecturerID." title="Type in a LecturerID">      <input type="text" style='width:auto;' id="SearchBoxName" onkeyup="SearchName()" placeholder="Search by LecturerName." title="Type in a Lecturer Name">      <input type="text" id="SearchBoxDepartment"  style='width:auto;' onkeyup="SearchDepartment()" placeholder="Search by Department." title="Type in a Department"></pre>
			
			<br>
			
			<div class='scroll-table'>
				<table border = 1 style = 'text-align: center; font-size: 25px;' id="Lecturer_List">
					<tr bgcolor = 'f8fca2' >
						<th width="150px">LecturerID</th>
						<th width="250px">LecturerName</th>
						<th width="250px">Password</th>
						<th width="250px">Department</th>
						<th width="100px">Edit</th>
						<th width="100px">Delete</th>
					</tr>
					
					<?php
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .="/sdp/db_connection.php";
					include_once($path);
					
					$sql = "Select * from lecturer ORDER BY LecturerID asc";
					$result = $conn ->query($sql);
					
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>'.$row['LecturerID'].'</td>';
							echo '<td>'.$row['LecturerName'].'</td>';
							echo '<td>'.$row['Password'].'</td>';
							echo '<td>'.$row['Department'].'</td>';
							echo '<td><a href = "edit_lecturer.php?LecturerID='.$row['LecturerID'].'"><button style="width:auto" class="editbutton"> √ </button></a></td>';
							echo '<td><a href = "delete_lecturer.php?LecturerID='.$row['LecturerID'].'"><button style="width:auto" class="deletebutton"> X </button></a></td>';
							echo '</tr>';
						}
					}
					
					mysqli_free_result($result);
					
					?>
				</table>
			</div>
			<input type="button" class='addbutton' style='font-size: 20px;' value="Add Lecturer" onclick="window.location='add_lecturer.php';">
		</div>
			
		<script>
		
		function SearchID() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("SearchBoxID");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("Lecturer_List");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
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
		
		function SearchName() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("SearchBoxName");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("Lecturer_List");
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
		
		function SearchDepartment() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("SearchBoxDepartment");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("Lecturer_List");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[3];
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
	</body>
</html>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			