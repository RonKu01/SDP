    <?php
//Step 1
//Step 2
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["student_login"])) {
	} else {
		header("location: ../../login.php");
	}

	$StudentTP = $_SESSION["StudentTP"];
	
//Step 3
$sql = "INSERT INTO `feedback`(`StudentTP`, `Bug`, `Details`, `admin_reply`) VALUES ('".$StudentTP."', '".$_POST['Bug']."', '".$_POST['Details']."', 'Pending')"; 

if(mysqli_query($conn, $sql))
	echo '<script>alert("Bug Report Submitted")</script>';
else
	echo '<script>alert("Failed to submit")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="feedback.php";</script>';
?>

