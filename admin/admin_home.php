 <?php
	
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../login.php");
	}
	
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);	
	
	$name = ($_SESSION['Admin_Name']);
	
 ?>
 
 
 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Admin Homepage</title>
		<link href = "admin.css" rel = "stylesheet" >
		<script src = "jvscript.js"></script>
		<script src = "jvscript2.js"></script>
	</head>
	
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			<ul>
				<li><a href ="#">Homepage</a></li>
				<li><a href='Manage_Admin/manage_profile.php'>Manage admin Profile</a> </li>
				<li><a href='Manage_Student/manage_student.php'>Manage student details</a> </li>
				<li><a href='Manage_Lecturer/manage_lecturer.php'>Manage lecturer details</a> </li>
				<li><a href='Manage_Staff/manage_staff.php'>Manage staff details</a> </li>
				<li>
					<a href="#" class="nav-extend-btn">Manage Classes
					<span class="fas fa-caret-down first"></span></a>
				<ul class="nav-extend-show">
					<li><a href='Manage_Class/Manage_Class_Details/class.php'>Class</a></li>
					<li><a href='Manage_Class/Manage_Course/manage_course.php'>Course</a></li>
					<li><a href='Manage_Class/Manage_Module/manage_module.php'>Module</a> </li>
				</ul>
				</li>
				<li><a href='Manage_Feedback/view_feedback.php'>Manage Feedbacks</a> </li>
				<li><a href="../logout.php">Logout</a></li>
			</ul>
		</nav>
		
		<div class='title'>
			<h2>Welcome <?php echo $name ?> to MG Academy Attendance System</h2>
		</div>
		
		<!-- Slideshow container -->
		<div class="slideshow-container">
		
			<!-- Full-width images with number and caption text -->

			<div class="mySlides fade">
				<div class="numbertext">1 / 3</div>
				<img src="img1.jpg" class="style_slideshow">
			</div>

			<div class="mySlides fade">
				<div class="numbertext">2 / 3</div>
				<img src="img2.jpeg" class="style_slideshow" >
			</div>

			<div class="mySlides fade">
				<div class="numbertext">3 / 3</div>
				<img src="img3.png" class="style_slideshow">
			</div>

			<!-- Next and previous buttons -->
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
		</div>
		
			<!-- The dots/circles -->
			<div style="text-align:center">
				<span class="dot" onclick="currentSlide(1)"></span> 
				<span class="dot" onclick="currentSlide(2)"></span> 
				<span class="dot" onclick="currentSlide(3)"></span>
			</div>

		<br><br><br>
		
		<hr/>
		<div class='footer'>
			<p> © 2021 MG Academy  | All Rights Reserved.</p>
		</div>
		
		<script>
			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
			  showSlides(slideIndex += n);
			}

			function currentSlide(n) {
			  showSlides(slideIndex = n);
			}

			function showSlides(n) {
			  var i;
			  var slides = document.getElementsByClassName("mySlides");
			  var dots = document.getElementsByClassName("dot");
			  if (n > slides.length) {slideIndex = 1}    
			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {
				  slides[i].style.display = "none";  
			  }
			  for (i = 0; i < dots.length; i++) {
				  dots[i].className = dots[i].className.replace(" active", "");
			  }
			  slides[slideIndex-1].style.display = "block";  
			  dots[slideIndex-1].className += " active";
			}
		</script>
		
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
	</body>
</html>













