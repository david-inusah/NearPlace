<?php
if(isset($_REQUEST['rating'])&&isset($_REQUEST['email'])) {

	include_once ("Functions.php");			
	$obj = new Functions();

	$rating=$_REQUEST['rating'];
	$email=$_REQUEST['email'];
	session_start();
	$usercode = $_SESSION['USERCODE'];

	if(!($obj->addRating($usercode,$rating))) {
		echo "An error occurred";
		header("location:rateapp.html");
	}else{
		echo "Done!";
		header("location:dashboard.html");
	}
}
else{
	echo "Please fill the required fields";
	header("location: rateapp.html");
}
?>