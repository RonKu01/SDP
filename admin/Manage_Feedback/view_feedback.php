   <?php
 
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
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
		<title>Manage Staff Account</title>
		<link href = "../admin.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
		<script src = "../navigation_bar.js"></script>
		
		<style>
		th {
		style='width:auto';
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
				<li><a href='#'>Manage Feedbacks</a> </li>
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
			<h2>Feedback Details</h2>
			
			<pre><input type="text" style="width:auto" id="SearchBoxStudentTP" onkeyup="SearchStudentTP()" placeholder="Search by StudentTP.">      <input type="text" style="width:auto"id="SearchBoxLecturerID" onkeyup="SearchLecturerID()" placeholder="Search by LecturerID.">      <input type="text" style="width:auto" id="SearchBoxStaffID" onkeyup="SearchStaffID()" placeholder="Search by StaffID.">      <input type="text" style="width:auto" id="SearchBoxRespond" onkeyup="SearchRespond()" placeholder="Search by Respond."></pre>
			<br>
			
			<div class='scroll-table' style="height:auto">
				<table border = 1 style = 'table-layout:fixed; width:1000px; font-size: 20px' id="Feedback_List">
					<tr bgcolor = 'f8fca2'>
						<th width="40px">ID</th>
						<th width="100px">StudentTP </th>
						<th width="100px">LecturerID</th>
						<th width="100px">StaffID</th>
						<th width="200px">Bug</th>
						<th width="200px">Details</th>
						<th width="200px">Created_At</th>
						<th width="200px">Respond</th>
						<th width="60px">Reply</th>
					</tr>
					<?php

					
					$sql = "Select * from feedback ORDER by ID desc";
					$result = $conn ->query($sql);
					
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>'.$row['ID'].'</td>';
							echo '<td>'.$row['StudentTP'].'</td>';
							echo '<td>'.$row['LecturerID'].'</td>';
							echo '<td>'.$row['Staff_ID'].'</td>';
							echo '<td>'.$row['Bug'].'</td>';
							echo '<td style="word-wrap: break-word">'.$row['Details'].'</td>';
							echo '<td width="150px">'.$row['Created_At'].'</td>';
							echo '<td style="word-wrap: break-word"> '.$row['Admin_Reply'].'</td>';						
							echo '<td style="text-align:center;"><a href = "reply_report.php?ID='.$row['ID'].'"><button class="editbutton"> > </button></a></td>';
							echo '</tr>';
						}
						mysqli_free_result($result);
					}
					mysqli_close($conn);
					?>
				</table>
			</div>
		</div>
			
		<script>
			function SearchStudentTP() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxStudentTP");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Feedback_List");
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
			
			
			function SearchLecturerID() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxLecturerID");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Feedback_List");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[2];
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
			
			function SearchStaffID() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxStaffID");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Feedback_List");
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
			
			function SearchRespond() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxRespond");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Feedback_List");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[7];
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
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			